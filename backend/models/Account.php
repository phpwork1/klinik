<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $code
 * @property string $name
 * @property string $beginning_balance
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Account map
 * @property AccountCategory $category
 * @property Expense[] $expenseCredits
 * @property Expense[] $expenseDebets
 * @property Income[] $incomeCredits
 * @property Income[] $incomeDebets
 * @property PurchasePayment[] $purchasePaymentCredits
 * @property PurchasePayment[] $purchasePaymentDebets
 * @property SalePayment[] $salePaymentCredits
 * @property SalePayment[] $salePaymentDebets
 */
class Account extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'name', 'beginning_balance'], 'required'],
            [['category_id', 'beginning_balance'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 12],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Kategori'),
            'code' => Yii::t('app', 'Kode Akun'),
            'name' => Yii::t('app', 'Nama Akun'),
            'beginning_balance' => Yii::t('app', 'Saldo Awal'),
            'created_at' => Yii::t('app', 'Terdaftar'),
            'updated_at' => Yii::t('app', 'Diubah'),
        ];
    }

    /**
     * Return array of key => value for dropdown menu
     * @param string $value value column name
     * @param string $type  credit or debet
     * @return \yii\db\ActiveQuery
     */
    public static function map($value = 'name', $type = NULL) {
        $value = empty($value) ? 'name' : $value;
        $where = '';
        switch ($type) {
            case 'incr':
                $where = 'group_id IN (4)';
                break;
            case 'indr':
                $where = 'group_id IN (1,3)';
                break;
            case 'spdr':
                $where = 'group_id IN (1,3)';
                break;
            case 'cr':
            case 'credit':
                $where = 'group_id IN (2,5,6,7)';
                break;
            case 'dr':
            case 'debet':
                $where = 'group_id IN (1,3,4,7)';
                break;
        }
        $map = ArrayHelper::map(Account::find()->joinWith('category')->andWhere($where)->orderBy([$value => SORT_ASC])->all(), 'id', $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Data Akun masih kosong. Segera tambahkan untuk menggunakan'));
        }
        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(AccountCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpensesCredits() {
        return $this->hasMany(Expense::className(), ['credit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseDebets() {
        return $this->hasMany(Expense::className(), ['debet' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeCredits() {
        return $this->hasMany(Income::className(), ['credit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeDebets() {
        return $this->hasMany(Income::className(), ['debet' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePaymentCredits() {
        return $this->hasMany(PurchasePayment::className(), ['credit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePaymentDebets() {
        return $this->hasMany(PurchasePayment::className(), ['debet' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalePaymentCredits() {
        return $this->hasMany(SalePayment::className(), ['credit' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalePaymentDebets() {
        return $this->hasMany(SalePayment::className(), ['debet' => 'id']);
    }

}
