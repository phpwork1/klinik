<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "r_doctor_action".
 *
 * @property integer $id
 * @property integer $registration_id
 * @property string $rda_name
 * @property integer $rda_price
 * @property RDoctorAction[] $map
 *
 * @property Registration $registration
 */
class RDoctorAction extends \yii\db\ActiveRecord
{
    public $position;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_doctor_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_id', 'rda_name', 'rda_price'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['registration_id', 'rda_price'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['rda_name'], 'string', 'max' => 100],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['registration_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'registration_id' => 'Registrasi',
            'rda_name' => 'Tindakan Praktik',
            'rda_price' => 'Harga',
        ];
    }

    public function beforeSave($insert)
    {
        if($this->position == 0){
            $this->rda_name = PracticeAction::find()->where(['id' => $this->rda_name])->one()->pa_name;
        }else{
            $this->rda_name = ClinicalAction::find()->where(['id' => $this->rda_name])->one()->ca_name;
        }
        return parent::beforeSave($insert);
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
    public static function getAll($value = 'name', $conditions = null) {
        $query = RDoctorAction::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'RDoctorAction database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['id' => 'registration_id']);
    }
}
