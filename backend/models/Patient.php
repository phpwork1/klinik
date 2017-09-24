<?php

namespace backend\models;

use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "patient".
 *
 * @property integer $id
 * @property integer $religion_id
 * @property integer $job_id
 * @property integer $patient_id
 * @property string $p_medical_number
 * @property string $p_registration_date
 * @property string $p_name
 * @property string $p_pob
 * @property string $p_dob
 * @property integer $p_gender
 * @property string $p_address
 * @property integer $p_postal_code
 * @property integer $p_contact_number
 * @property string $p_ref
 * @property Patient[] $map
 *
 * @property Patient $patient
 * @property Patient[] $patients
 * @property Job $job
 * @property Religion $religion
 * @property Registration[] $registrations
 * @property DrugAllergies[] $drugAllergiess
 */
class Patient extends \yii\db\ActiveRecord
{

    const GENDER_MAN = 0;
    const GENDER_WOMAN = 1;

    public $genderList = [
        self::GENDER_MAN => 'Laki-Laki',
        self::GENDER_WOMAN => 'Perempuan',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religion_id', 'job_id', 'p_medical_number', 'p_registration_date', 'p_name', 'p_pob', 'p_dob', 'p_gender', 'p_address', 'p_postal_code', 'p_contact_number'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['religion_id', 'job_id', 'patient_id', 'p_gender', 'p_postal_code', 'p_contact_number'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['p_registration_date', 'p_dob'], 'safe'],
            [['p_medical_number'], 'string', 'max' => 10],
            [['p_name'], 'string', 'max' => 50],
            [['p_pob'], 'string', 'max' => 20],
            [['p_address'], 'string', 'max' => 100],
            [['p_ref'], 'string', 'max' => 150],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['religion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Religion::className(), 'targetAttribute' => ['religion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'religion_id' => Yii::t('app', 'Agama'),
            'job_id' => Yii::t('app', 'Pekerjaan'),
            'patient_id' => Yii::t('app', 'Anggota Keluarga'),
            'p_medical_number' => Yii::t('app', 'Nomor Pasien'),
            'p_registration_date' => Yii::t('app', 'Tanggal Registrasi'),
            'p_name' => Yii::t('app', 'Nama Pasien'),
            'p_pob' => Yii::t('app', 'Tempat Lahir'),
            'p_dob' => Yii::t('app', 'Tanggal Lahir'),
            'p_gender' => Yii::t('app', 'Jenis Kelamin'),
            'p_address' => Yii::t('app', 'Alamat'),
            'p_postal_code' => Yii::t('app', 'Kode Pos'),
            'p_contact_number' => Yii::t('app', 'Telp / HP'),
            'p_ref' => Yii::t('app', 'Keterangan'),
        ];
    }

    public function getGenderType() {
        return $this->genderList[$this->p_gender];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->p_registration_date == '') {
            $this->p_registration_date = Yii::$app->formatter->asDate($this->p_registration_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if(!$this->p_dob == '') {
            $this->p_dob = Yii::$app->formatter->asDate($this->p_dob, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind() {
        parent::afterFind();

        if(!$this->p_registration_date == '') {
            $this->p_registration_date = Yii::$app->formatter->asDate($this->p_registration_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        if(!$this->p_dob == '') {
            $this->p_dob = Yii::$app->formatter->asDate($this->p_dob, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        return true;
    }

    public function saveTransactional()
    {

        $request = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $errors = [];

        try {
            $this->load($request);

            //make sure patient name first letter is capital
            if ($this->p_name != ucfirst($this->p_name)) {
                $this->p_name = ucfirst($this->p_name);
            }

            $this->p_registration_date = time();

            $patientFirstLetter = $this->p_name[0];
            //creating medical number
            $count = Patient::find()->where(['like', 'patient.p_name', $patientFirstLetter . '%', false])->count();
            $this->p_medical_number = sprintf("%s.%05d", $patientFirstLetter, $count + 1);
            if (!$this->save()) {
                $errors = array_merge($errors, $this->errors);
                throw new Exception();
            }

            $transaction->commit();
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollBack();

            foreach ($errors as $attr => $errorArr) {
                $error = join('<br />', $errorArr);
                Yii::$app->session->addFlash('danger', $error);
            }

            return FALSE;
        }
    }

    /**
    * @return \yii\behaviors\TimestampBehavior
    */
    //public function behaviors() {
    //    return [
    //        'timestamp' => [
    //            'class' => TimestampBehavior::className(),
    //            'attributes' => [
    //                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
    //                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    //            ],
    //            'value' => new Expression('NOW()'),
    //        ],
    //    ];
    //}
    
    /**
    * @inheritdoc
    */
    //public function beforeSave($insert) {
    //    if ($this->isNewRecord) {
    //        $this->created_by = Yii::$app->user->id;
    //    } else {
    //        $this->updated_by = Yii::$app->user->id;
    //    }
    //    return parent::beforeSave($insert);
    //}
    
    /**
    * Return model objects
    * @param string $value default to 'name'
    * @param string $conditions default to null
    * @return \yii\db\ActiveRecord[]
    */
    public static function getAll($value = 'p_name', $conditions = null) {
        $query = Patient::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query->all();
    }

    /**
    * Return array of key => value for dropdown menu
    * @param string $key default to 'id'
    * @param string $value default to 'name'
    * @param string $conditions default to null
    * @return array
    */
    public static function map($key = 'id', $value = 'p_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);

        $map = array("" => '--Silahkan Pilih--') + $map;
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugAllergiess()
    {
        return $this->hasMany(DrugAllergies::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReligion()
    {
        return $this->hasOne(Religion::className(), ['id' => 'religion_id']);
    }
}
