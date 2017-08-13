<?php

namespace backend\models;

use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "religion".
 *
 * @property integer $id
 * @property string $r_name
 * @property Religion[] $map
 *
 * @property Patient[] $patients
 */
class Religion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_name'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['r_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'r_name' => Yii::t('app', 'Nama Agama'),
        ];
    }

    public static function getReligionName($id){
        return Religion::find()->where(['id' => $id])->one()->r_name;
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
    * @return \yii\db\ActiveQuery
    */
    public static function getAll($value = 'r_name', $conditions = null) {
        $query = Religion::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query;
    }

    /**
    * Return array of key => value for dropdown menu
    * @param string $key default to 'id'
    * @param string $value default to 'name'
    * @param string $conditions default to null
    * @return array
    */
    public static function map($key = 'id', $value = 'r_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'r_name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions)->all(), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Religion database still empty. Please add the data as soon as possible.'));
        }
        $map = array("" => '--Silahkan Pilih--') + $map;
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patient::className(), ['religion_id' => 'id']);
    }
}
