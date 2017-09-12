<?php

namespace frontend\models;

use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "sales".
 *
 * @property integer $id
 * @property string $s_invoice_number
 * @property string $s_date
 * @property string $s_cashier
 * @property string $s_buyer
 * @property integer $s_total_paid
 * @property Sales[] $map
 *
 * @property SalesDetail[] $salesDetails
 * @property SalesType[] $salesTypes
 */
class Sales extends \yii\db\ActiveRecord
{
    public $total;
    public $change;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_invoice_number', 's_date', 's_total_paid', 's_buyer'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['s_date'], 'safe'],
            [['s_total_paid'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['s_invoice_number'], 'string', 'max' => 100],
            [['s_cashier', 's_buyer'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_invoice_number' => 'No. Nota',
            's_date' => 'Tanggal',
            's_cashier' => 'Kasir',
            's_buyer' => 'Nama Pembeli',
            's_total_paid' => 'Total Dibayar',
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
        $query = Sales::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Sales database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDetails()
    {
        return $this->hasMany(SalesDetail::className(), ['sales_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesTypes()
    {
        return $this->hasMany(SalesType::className(), ['sales_id' => 'id']);
    }
}
