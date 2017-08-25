<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "r_consultation".
 *
 * @property integer $id
 * @property integer $registration_id
 * @property string $c_history
 * @property string $c_td_value
 * @property string $c_pr_value
 * @property string $c_t_value
 * @property string $c_rr_value
 * @property string $c_description
 * @property string $c_support
 * @property integer $c_control_days
 * @property RConsultation[] $map
 *
 * @property Registration $registration
 */
class RConsultation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_consultation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_id'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['registration_id', 'c_control_days'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['c_history', 'c_description', 'c_support'], 'string'],
            [['c_td_value', 'c_pr_value', 'c_t_value', 'c_rr_value'], 'string', 'max' => 20],
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
            'c_history' => 'Anamnesis',
            'c_td_value' => 'TD',
            'c_pr_value' => 'PR',
            'c_t_value' => 'T',
            'c_rr_value' => 'RR',
            'c_description' => 'Detail Pemeriksaan',
            'c_support' => 'Pemeriksaan Penunjang',
            'c_control_days' => 'Pasien Kontrol',
        ];
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
        $query = RConsultation::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'RConsultation database still empty. Please add the data as soon as possible.'));
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
