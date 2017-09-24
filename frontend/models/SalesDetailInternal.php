<?php

namespace frontend\models;

use backend\models\RMedicine;
use common\components\helpers\AppConst;
use yii\helpers\ArrayHelper;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "sales_detail_internal".
 *
 * @property integer $id
 * @property integer $sales_detail_id
 * @property integer $r_medicine_id
 * @property SalesDetailInternal[] $map
 *
 * @property SalesDetail $salesDetail
 * @property RMedicine $rMedicine
 */
class SalesDetailInternal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_detail_internal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_detail_id', 'r_medicine_id'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['sales_detail_id', 'r_medicine_id'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['sales_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesDetail::className(), 'targetAttribute' => ['sales_detail_id' => 'id']],
            [['r_medicine_id'], 'exist', 'skipOnError' => true, 'targetClass' => RMedicine::className(), 'targetAttribute' => ['r_medicine_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_detail_id' => 'Penjualan',
            'r_medicine_id' => 'Obat',
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
        $query = SalesDetailInternal::find()->orderBy([$value => SORT_ASC]);
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
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDetail()
    {
        return $this->hasOne(SalesDetail::className(), ['id' => 'sales_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRMedicine()
    {
        return $this->hasOne(RMedicine::className(), ['id' => 'r_medicine_id']);
    }
}
