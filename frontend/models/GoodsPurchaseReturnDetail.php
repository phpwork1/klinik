<?php

namespace frontend\models;

use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods_purchase_return_detail".
 *
 * @property integer $id
 * @property integer $goods_purchase_return_id
 * @property integer $gp_detail_id
 * @property string $gprd_name
 * @property integer $gprd_quantity
 * @property integer $gprd_price
 * @property integer $gprd_total
 * @property GoodsPurchaseReturnDetail[] $map
 *
 * @property GoodsPurchaseReturn $goodsPurchaseReturn
 */
class GoodsPurchaseReturnDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_purchase_return_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gp_detail_id', 'goods_purchase_return_id', 'gprd_name', 'gprd_quantity', 'gprd_price', 'gprd_total'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['gp_detail_id', 'goods_purchase_return_id', 'gprd_quantity', 'gprd_price', 'gprd_total'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['gprd_name'], 'string', 'max' => 50],
            [['goods_purchase_return_id'], 'exist', 'skipOnError' => true, 'targetClass' => GoodsPurchaseReturn::className(), 'targetAttribute' => ['goods_purchase_return_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'goods_purchase_return_id' => 'Retur Pembelian',
            'gp_detail_id' => 'Detail Pembelian',
            'gprd_name' => 'Nama Barang',
            'gprd_quantity' => 'Jumlah',
            'gprd_price' => 'Harga',
            'gprd_total' => 'Total Harga',
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
        $query = GoodsPurchaseReturnDetail::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'GoodsPurchaseReturnDetail database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsPurchaseReturn()
    {
        return $this->hasOne(GoodsPurchaseReturn::className(), ['id' => 'goods_purchase_return_id']);
    }
}
