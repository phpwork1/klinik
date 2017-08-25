<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "r_diagnosis".
 *
 * @property integer $id
 * @property integer $registration_id
 * @property string $rd_name
 * @property RDiagnosis[] $map
 *
 * @property Registration $registration
 */
class RDiagnosis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_diagnosis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_id', 'rd_name'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['registration_id'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['rd_name'], 'string', 'max' => 100],
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
            'rd_name' => 'Nama Diagnosis',
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
        $query = RDiagnosis::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'RDiagnosis database still empty. Please add the data as soon as possible.'));
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
