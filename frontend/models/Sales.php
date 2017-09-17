<?php

namespace frontend\models;

use backend\models\Registration;
use common\components\helpers\AppConst;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
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
            ['s_invoice_number', 'unique', 'message' => '{attribute} sudah terdaftar'],
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

    public static function getAll($value = 'name', $conditions = null)
    {
        $query = Sales::find()->orderBy([$value => SORT_ASC]);
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }
        return $query->all();
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if (!$this->s_date == '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        if (!$this->s_date == '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConst::FORMAT_DATE_PHP_SHOW_MONTH);
        }
    }

    public function getInvoiceNumber(){
        return sprintf("%s%03d",Yii::$app->formatter->asDate(time(), 'YMMdd'),Sales::find()->where(['s_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count()+1);
    }

    public function saveTransactional()
    {
        $request = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $errors = [];

        try {
            $this->load($request);

            if (!$this->save()) {
                $errors = array_merge($errors, $this->errors);
                throw new Exception();
            }

            $salesId = $this->id;

            if (isset($request['SalesType'])) {
                $salesType = $request['SalesType'];
                if (isset($salesType['id'])) {
                    $salesTypeTuple = SalesType::findOne(['id' => $salesType['id']]);
                } else {
                    $salesTypeTuple = new SalesType();
                    $salesTypeTuple->sales_id = $salesId;
                    $registrationModel = Registration::findOne(['id' => $request['SalesType']['registration_id']]);
                    $registrationModel->r_paid = 1;
                    if(!$registrationModel->save()){
                        $errors = array_merge($errors, $salesTypeTuple->errors);
                        throw new Exception();
                    }
                }

                if (!$salesTypeTuple->load(['SalesType' => $salesType]) || !$salesTypeTuple->save()) {
                    $errors = array_merge($errors, $salesTypeTuple->errors);
                    throw new Exception();
                }
            }

            if (isset($request['SalesDetail'])) {
                foreach ($request['SalesDetail'] as $key => $detail) {
                    if (isset($detail['id'])) {
                        $detailTuple = SalesDetail::findOne(['id' => $detail['id']]);
                    } else {
                        $detailTuple = new SalesDetail();
                        $detailTuple->sales_id = $salesId;
                    }

                    if ($detailTuple->load(['SalesDetail' => $detail]) && $detailTuple->save()) {
                        if (isset($request['SalesDetailInternal'][$key])) {
                            $internalTuple = new SalesDetailInternal();
                            $internalTuple->sales_detail_id = $detailTuple->id;
                            if (!$internalTuple->load(['SalesDetailInternal' => $request['SalesDetailInternal'][$key]]) || !$internalTuple->save()) {
                                $errors = array_merge($errors, $internalTuple->errors);
                                throw new Exception();
                            }
                        }
                    } else {
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
    public static function map($key = 'id', $value = 'name', $conditions = null)
    {
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
