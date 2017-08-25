<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "practice_action".
 *
 * @property integer $id
 * @property string $pa_name
 * @property integer $pa_cost
 */
class PracticeAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'practice_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pa_name', 'pa_cost'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['pa_cost'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['pa_name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pa_name' => Yii::t('app', 'Nama Layanan'),
            'pa_cost' => Yii::t('app', 'Biaya'),
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
    public static function getAll($value = 'pa_name', $conditions = null) {
        $query = PracticeAction::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'pa_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'pa_name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'PracticeAction database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }

}
