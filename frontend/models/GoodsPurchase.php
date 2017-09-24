<?php

namespace frontend\models;

use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods_purchase".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property string $gp_invoice_number
 * @property string $gp_date
 * @property integer $gp_payment_method
 * @property string $gp_due_date
 * @property integer $gp_discount
 * @property integer $gp_ppn
 * @property string $gp_cashier
 * @property GoodsPurchase[] $map
 *
 * @property Supplier $supplier
 * @property GpDetail[] $gpDetails
 */
class GoodsPurchase extends \yii\db\ActiveRecord
{
    public $subTotal;
    public $total;
    public $paymentName;
    public $totalView;

    const PAYMENT_TYPE_CREDIT = 0;
    const PAYMENT_TYPE_CASH = 1;

    public $paymentTypeList = [
        self::PAYMENT_TYPE_CREDIT => 'Kredit',
        self::PAYMENT_TYPE_CASH => 'Cash',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'gp_invoice_number', 'gp_date', 'gp_payment_method', 'gp_due_date', 'gp_discount', 'gp_ppn'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['supplier_id', 'gp_payment_method', 'gp_discount', 'gp_ppn'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['gp_date', 'gp_due_date'], 'safe'],
            [['gp_invoice_number'], 'string', 'max' => 100],
            [['gp_cashier'], 'string', 'max' => 50],
            ['gp_invoice_number', 'unique', 'message' => '{attribute} sudah terdaftar'],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'supplier_id' => 'Kode Supplier',
            'gp_invoice_number' => 'No Faktur',
            'gp_date' => 'Tgl Transaksi',
            'gp_payment_method' => 'Metode Pembayaran',
            'gp_due_date' => 'Jatuh Tempo',
            'gp_discount' => 'Potongan',
            'gp_ppn' => 'PPN (%)',
            'gp_cashier' => 'Kasir',
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

    public function getInvoiceNumber(){
        return sprintf("%s%03d",Yii::$app->formatter->asDate(time(), 'YMMdd'),GoodsPurchase::find()->where(['gp_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count()+1);
    }

    public function getPaymentType() {
        return $this->paymentTypeList[$this->gp_payment_method];
    }

    public function getTotalPayment(){
        $temp = 0;
        foreach($this->gpDetails as $key => $value) {
            $temp += $value->gpd_quantity * $value->gpd_price;
        }

        $temp = $temp - $temp*$this->gp_discount/100;
        $temp = $temp + $temp*$this->gp_ppn/100;


        return $temp;
    }


    public static function getAll($value = 'name', $conditions = null) {
        $query = GoodsPurchase::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        $result = $query->all();
        foreach($result as $key => $value) {
            $value->gp_invoice_number = sprintf("%s | %s | %s", $value->gp_invoice_number, $value->gp_date, $value->supplier->s_name);
        }
        return $result;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->gp_due_date == '') {
            $this->gp_due_date = Yii::$app->formatter->asDate($this->gp_due_date, AppConst::FORMAT_DB_DATE_PHP);
        }
        if(!$this->gp_date == '') {
            $this->gp_date = Yii::$app->formatter->asDate($this->gp_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if(!$this->gp_due_date == '') {
            $this->gp_due_date = Yii::$app->formatter->asDate($this->gp_due_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }
        if(!$this->gp_date == '') {
            $this->gp_date = Yii::$app->formatter->asDate($this->gp_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        $this->paymentName = $this->getPaymentType();
        $this->totalView = number_format($this->getTotalPayment(),0);
    }

    public function saveTransactional() {
        $request = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $errors = [];

        try {
            $this->load($request);

            if (!$this->save()) {
                $errors = array_merge($errors, $this->errors);
                throw new Exception();
            }

            $goodsPurchaseId = $this->id;

            if (isset($request['GpDetail'])) {
                foreach ($request['GpDetail'] as $key => $detail) {
                    if (isset($detail['id'])) {
                        $detailTuple = GpDetail::findOne(['id' => $detail['id']]);
                    } else {
                        $detailTuple = new GpDetail();
                        $detailTuple->goods_purchase_id = $goodsPurchaseId;
                    }

                    if (!$detailTuple->load(['GpDetail' => $detail]) || !$detailTuple->save()) {
                        $errors = array_merge($errors, $detailTuple->errors);
                        throw new Exception();
                    }
                }
            }

            $transaction->commit();
            return TRUE;

        } catch (Exception $e) {
            $transaction->rollBack();
            $this->afterFind();

            foreach ($errors as $attr => $errorArr) {
                $error = join('<br />', $errorArr);
                Yii::$app->session->addFlash('danger', $error);
            }

            return FALSE;
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
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGpDetails()
    {
        return $this->hasMany(GpDetail::className(), ['goods_purchase_id' => 'id']);
    }
}
