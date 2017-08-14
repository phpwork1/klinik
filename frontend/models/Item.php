<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $item_category_id
 * @property string $i_name
 * @property string $i_barcode
 * @property string $i_description
 * @property string $i_factory
 * @property integer $i_buy_price
 * @property integer $i_sell_price
 * @property integer $i_ppn
 * @property integer $i_retail_price
 * @property integer $i_net_price
 * @property integer $i_blend_price
 * @property integer $i_stock_amount
 * @property string $i_unit
 * @property integer $i_stock_min
 * @property integer $i_stock_max
 * @property string $i_expired_date
 * @property Item[] $map
 *
 * @property ItemCategory $itemCategory
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_category_id', 'i_name', 'i_buy_price', 'i_sell_price', 'i_stock_amount'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['item_category_id', 'i_buy_price', 'i_sell_price', 'i_ppn', 'i_retail_price', 'i_net_price', 'i_blend_price', 'i_stock_amount', 'i_stock_min', 'i_stock_max'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['i_description'], 'string'],
            [['i_expired_date'], 'safe'],
            [['i_name', 'i_factory'], 'string', 'max' => 50],
            [['i_barcode'], 'string', 'max' => 200],
            [['i_unit'], 'string', 'max' => 30],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['item_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Kode'),
            'item_category_id' => Yii::t('app', 'Jenis Barang'),
            'i_name' => Yii::t('app', 'Nama'),
            'i_barcode' => Yii::t('app', 'Barcode'),
            'i_description' => Yii::t('app', 'Deskripsi'),
            'i_factory' => Yii::t('app', 'Pabrik'),
            'i_buy_price' => Yii::t('app', 'Harga Beli'),
            'i_sell_price' => Yii::t('app', 'Harga Jual'),
            'i_ppn' => Yii::t('app', 'HNA+PPn'),
            'i_retail_price' => Yii::t('app', 'Harga Retail'),
            'i_net_price' => Yii::t('app', 'Harga Net'),
            'i_blend_price' => Yii::t('app', 'Harga Racik'),
            'i_stock_amount' => Yii::t('app', 'Stock Awal'),
            'i_unit' => Yii::t('app', 'Satuan'),
            'i_stock_min' => Yii::t('app', 'Stok Minimum'),
            'i_stock_max' => Yii::t('app', 'Stok Maksimum'),
            'i_expired_date' => Yii::t('app', 'Expired Date'),
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->i_expired_date == '') {
            $this->i_expired_date = Yii::$app->formatter->asDate($this->i_expired_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind() {
        parent::afterFind();

        if(!$this->i_expired_date == '') {
            $this->i_expired_date = Yii::$app->formatter->asDate($this->i_expired_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        return true;
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
    public static function getAll($value = 'i_name', $conditions = null) {
        $query = Item::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 'i_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Item database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'item_category_id']);
    }
}
