<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "gp_detail".
 *
 * @property integer $id
 * @property integer $goods_purchase_id
 * @property integer $item_id
 * @property integer $gpd_price
 * @property integer $gpd_quantity
 * @property string $gpd_expire_date
 * @property GpDetail[] $map
 *
 * @property GoodsPurchase $goodsPurchase
 * @property Item $item
 */
class GpDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gp_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_purchase_id', 'item_id', 'gpd_price', 'gpd_quantity', 'gpd_expire_date'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['goods_purchase_id', 'item_id', 'gpd_price', 'gpd_quantity'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['gpd_expire_date'], 'safe'],
            [['goods_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => GoodsPurchase::className(), 'targetAttribute' => ['goods_purchase_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'goods_purchase_id' => 'Kode Pembelian',
            'item_id' => 'Barang',
            'gpd_price' => 'Harga',
            'gpd_quantity' => 'Jumlah',
            'gpd_expire_date' => 'Tgl Expire',
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
        $query = GpDetail::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query->all();
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->gpd_expire_date == '') {
            $this->gpd_expire_date = Yii::$app->formatter->asDate($this->gpd_expire_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if(!$this->gpd_expire_date == '') {
            $this->gpd_expire_date = Yii::$app->formatter->asDate($this->gpd_expire_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'GpDetail database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }

    public static function dropdownItemMap($id) {
        $data =[];
        $gpDetails = GoodsPurchase::find()->where(['id' => $id])->one()->gpDetails;

        foreach($gpDetails as $key => $value){
            $data[$value->id] = sprintf("%s | %s", $value->item->i_name, $value->gpd_price);
        }
        if (empty($data)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'GpDetail database still empty. Please add the data as soon as possible.'));
        }
        return $data;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsPurchase()
    {
        return $this->hasOne(GoodsPurchase::className(), ['id' => 'goods_purchase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
