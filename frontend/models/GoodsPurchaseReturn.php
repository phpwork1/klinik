<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;
use yii\base\Exception;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods_purchase_return".
 *
 * @property integer $id
 * @property integer $goods_purchase_id
 * @property string $gpr_return_number
 * @property string $gpr_date
 * @property string $gpr_supplier_name
 * @property integer $gpr_total_return
 * @property GoodsPurchaseReturn[] $map
 *
 * @property GoodsPurchase $goodsPurchase
 * @property GoodsPurchaseReturnDetail[] $goodsPurchaseReturnDetails
 */
class GoodsPurchaseReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_purchase_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_purchase_id', 'gpr_return_number', 'gpr_date', 'gpr_total_return'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['goods_purchase_id', 'gpr_total_return'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['gpr_date'], 'safe'],
            [['gpr_return_number', 'gpr_supplier_name'], 'string', 'max' => 50],
            [['goods_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => GoodsPurchase::className(), 'targetAttribute' => ['goods_purchase_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'goods_purchase_id' => 'Pembelian',
            'gpr_return_number' => 'No. Retur',
            'gpr_date' => 'Tanggal',
            'gpr_supplier_name' => 'Nama Suplier',
            'gpr_total_return' => 'Total',
        ];
    }

    /**
    * @return \yii\behaviors\TimestampBehavior
    */

    public function getInvoiceNumber(){
        return sprintf("%s%03d",Yii::$app->formatter->asDate(time(), 'YMMdd'),GoodsPurchaseReturn::find()->where(['gpr_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count()+1);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->gpr_date == '') {
            $this->gpr_date = Yii::$app->formatter->asDate($this->gpr_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if(!$this->gpr_date == '') {
            $this->gpr_date = Yii::$app->formatter->asDate($this->gpr_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }
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

            $goodsPurchaseReturnId = $this->id;

            if (isset($request['GoodsPurchaseReturnDetail'])) {
                foreach ($request['GoodsPurchaseReturnDetail'] as $key => $detail) {
                    if (isset($detail['id'])) {
                        $detailTuple = GoodsPurchaseReturnDetail::findOne(['id' => $detail['id']]);
                    } else {
                        $detailTuple = new GoodsPurchaseReturnDetail();
                        $detailTuple->goods_purchase_return_id = $goodsPurchaseReturnId;
                    }

                    if (!$detailTuple->load(['GoodsPurchaseReturnDetail' => $detail]) || !$detailTuple->save()) {
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
        $query = GoodsPurchaseReturn::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'GoodsPurchaseReturn database still empty. Please add the data as soon as possible.'));
        }
        return $map;
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
    public function getGoodsPurchaseReturnDetails()
    {
        return $this->hasMany(GoodsPurchaseReturnDetail::className(), ['goods_purchase_return_id' => 'id']);
    }
}
