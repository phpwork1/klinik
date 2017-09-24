<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "registration".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property string $r_number
 * @property string $r_date
 * @property integer $r_patient_weight
 * @property integer $r_patient_tension
 * @property integer $r_patient_temp
 * @property string $r_complaint
 * @property integer $r_position
 * @property bool $r_checked
 * @property bool $r_paid
 * @property Registration[] $map
 *
 * @property DrugAllergies[] $drugAllergies
 * @property RConsultation[] $rConsultations
 * @property RDiagnosis[] $rDiagnoses
 * @property RDoctorAction[] $rDoctorActions
 * @property RMedicine[] $rMedicines
 * @property Patient $patient
 */
class Registration extends \yii\db\ActiveRecord
{
    public $r_position_desc;
    public $drugAllergiesData;

    const ACTION_PRACTICE = 0;
    const ACTION_CLINICK = 1;

    public $actionList = [
        self::ACTION_PRACTICE => 'Praktik Dokter',
        self::ACTION_CLINICK => 'Klinik Kecantikan',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_checked','r_paid','r_position', 'patient_id', 'r_number', 'r_date'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['r_position','patient_id', 'r_patient_weight', 'r_patient_tension', 'r_patient_temp'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['r_date'], 'safe'],
            [['r_complaint'], 'string'],
            [['r_number'], 'string', 'max' => 30],
            ['r_number', 'unique', 'message' => '{attribute} sudah terdaftar', 'targetAttribute' => ['r_number', 'r_date']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'patient_id' => 'Pasien',
            'r_number' => 'No. Registrasi',
            'r_date' => 'Tgl. Registrasi',
            'r_patient_weight' => 'Berat Badan (Kg)',
            'r_patient_tension' => 'Tensi',
            'r_patient_temp' => 'Suhu Badan',
            'r_complaint' => 'Keluhan',
            'r_position' => 'Posisi',
        ];
    }

    public function getActionName() {
        return $this->actionList[$this->r_position];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->r_date == '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->r_position_desc = $this->getActionName();

        if(!$this->r_date == '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }
    }

    public function getRegistrationNumber(){
        return Registration::find()->where(['r_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count() + 1;
    }

    public function getDrugAllergiesData(){
        $query = DrugAllergies::map('id', 'da_name', ['patient_id' => $this->patient_id]);
//        $query = DrugAllergies::find()->select(['da_name'])->where(['patient_id' => $this->patient_id])->all();
//        foreach($query as $key => $value){
//            $this->drugAllergiesData[$key] = $value->da_name;
//        }
//        $this->drugAllergiesData = $query;
        return $query;
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
    public static function getAll($value = 'r_number', $conditions = null) {
        $query = Registration::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'r_number', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugAllergies()
    {
        return $this->hasMany(DrugAllergies::className(), ['registration_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRConsultations()
    {
        return $this->hasMany(RConsultation::className(), ['registration_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRDiagnoses()
    {
        return $this->hasMany(RDiagnosis::className(), ['registration_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRDoctorActions()
    {
        return $this->hasMany(RDoctorAction::className(), ['registration_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRMedicines()
    {
        return $this->hasMany(RMedicine::className(), ['registration_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }
}
