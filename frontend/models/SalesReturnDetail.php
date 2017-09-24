<?php

namespace frontend\models;

use backend\models\RMedicine;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "sales_return_detail".
 *
 * @property integer $id
 * @property integer $sales_detail_id
 * @property integer $sales_return_id
 * @property string $srd_name
 * @property integer $srd_quantity
 * @property integer $srd_price
 * @property integer $srd_total
 * @property SalesReturnDetail[] $map
 *
 * @property SalesReturn $salesReturn
 */
class SalesReturnDetail extends \yii\db\ActiveRecord
{
    public $itemDetailsMap = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_return_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_detail_id', 'sales_return_id', 'srd_name', 'srd_quantity', 'srd_price', 'srd_total'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['sales_detail_id', 'sales_return_id', 'srd_quantity', 'srd_price', 'srd_total'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['srd_name'], 'string', 'max' => 50],
            [['sales_return_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesReturn::className(), 'targetAttribute' => ['sales_return_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_detail_id' => 'Detail Penjualan',
            'sales_return_id' => 'Retur Penjualan',
            'srd_name' => 'Nama Barang',
            'srd_quantity' => 'Jumlah',
            'srd_price' => 'Harga',
            'srd_total' => 'Total Harga',
        ];
    }

    public function getItemDetails(){
        $salesDetail = SalesDetail::find()->where(['id' => $this->sales_detail_id])->one();
        $rMedicineId = $salesDetail->salesDetailInternals[0]->r_medicine_id;
        $rmDetails = RMedicine::find()->where(['id' => $rMedicineId])->one()->rmDetails;

        foreach($rmDetails as $key => $value) {
            $this->itemDetailsMap[] = [
                'name' => $value->item->i_name . " >> " . $value->rmd_amount . " x Rp. " . number_format($salesDetail->item->i_blend_price, 0, '.', ',') . " = Rp. " . number_format($value->rmd_amount * $salesDetail->item->i_blend_price, 0, '.', ','),
            ];
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
    public static function getAll($value = 'name', $conditions = null) {
        $query = SalesReturnDetail::find()->orderBy([$value => SORT_ASC]);
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
    public function getSalesReturn()
    {
        return $this->hasOne(SalesReturn::className(), ['id' => 'sales_return_id']);
    }
}
