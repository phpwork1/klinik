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
 * This is the model class for table "sales_return".
 *
 * @property integer $id
 * @property integer $sales_id
 * @property string $sr_return_number
 * @property string $sr_date
 * @property string $sr_buyer
 * @property integer $sr_total_return
 * @property SalesReturn[] $map
 *
 * @property Sales $sales
 * @property SalesReturnDetail[] $salesReturnDetails
 */
class SalesReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sr_buyer', 'sales_id', 'sr_return_number', 'sr_date', 'sr_total_return'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['sales_id', 'sr_total_return'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['sr_date'], 'safe'],
            [['sr_buyer', 'sr_return_number'], 'string', 'max' => 50],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_id' => 'Penjualan',
            'sr_return_number' => 'No. Nota',
            'sr_date' => 'Tanggal',
            'sr_buyer' => 'Nama Pelanggan',
            'sr_total_return' => 'Total Harga',
        ];
    }

    public function getInvoiceNumber(){
        return sprintf("%s%03d",Yii::$app->formatter->asDate(time(), 'YMMdd'),SalesReturn::find()->where(['sr_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count()+1);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if(!$this->sr_date == '') {
            $this->sr_date = Yii::$app->formatter->asDate($this->sr_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if(!$this->sr_date == '') {
            $this->sr_date = Yii::$app->formatter->asDate($this->sr_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }

        foreach($this->salesReturnDetails as $key => $value){
            if(!empty($this->sales->salesTypes)) {
                $value->getItemDetails();
            }
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

            $salesReturnId = $this->id;

            if (isset($request['SalesReturnDetail'])) {
                foreach ($request['SalesReturnDetail'] as $key => $detail) {
                    if (isset($detail['id'])) {
                        $detailTuple = SalesReturnDetail::findOne(['id' => $detail['id']]);
                    } else {
                        $detailTuple = new SalesReturnDetail();
                        $detailTuple->sales_return_id = $salesReturnId;
                    }

                    if (!$detailTuple->load(['SalesReturnDetail' => $detail]) || !$detailTuple->save()) {
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
        $query = SalesReturn::find()->orderBy([$value => SORT_ASC]);
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
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['id' => 'sales_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesReturnDetails()
    {
        return $this->hasMany(SalesReturnDetail::className(), ['sales_return_id' => 'id']);
    }
}
