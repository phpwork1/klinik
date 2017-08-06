<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "parameter".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $province
 * @property integer $zip_code
 * @property string $phone
 * @property string $mobile
 * @property string $pin
 * @property string $facebook
 * @property string $twitter
 * @property string $logo
 * @property string $slogan
 * @property string $app_name
 * @property string $header
 * @property string $footer
 * @property string $backend_theme
 * @property string $frontend_theme
 * @property string $reset_username
 * @property string $reset_password
 * @property string $empty_username
 * @property string $empty_password
 * @property string $invoice_printer
 * @property string $receipt_printer
 * 
 * @property Printer $invoicePrinter
 * @property Printer $receiptPrinter
 */
class Parameter extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'address', 'city', 'province', 'zip_code', 'phone', 'app_name'], 'required'],
            [['zip_code'], 'integer'],
            [['name', 'app_name'], 'string', 'max' => 48],
            [['address'], 'string', 'max' => 96],
            [['city', 'province', 'reset_username', 'empty_username'], 'string', 'max' => 24],
            [['phone', 'mobile'], 'string', 'max' => 32],
            [['pin'], 'string', 'max' => 10],
            [['facebook', 'twitter'], 'string', 'max' => 64],
            [['logo', 'reset_password', 'empty_password'], 'string', 'max' => 50],
            [['slogan', 'header', 'footer'], 'string', 'max' => 128]
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['printer'] = ['invoice_printer', 'receipt_printer']; //Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'pin' => Yii::t('app', 'Pin'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'logo' => Yii::t('app', 'Logo'),
            'slogan' => Yii::t('app', 'Slogan'),
            'app_name' => Yii::t('app', 'App Name'),
            'header' => Yii::t('app', 'Header'),
            'footer' => Yii::t('app', 'Footer'),
            'invoice_printer' => Yii::t('app', 'Printer Nota'),
            'receipt_printer' => Yii::t('app', 'Printer TT'),
            'backend_theme' => Yii::t('app', 'Backend Theme'),
            'frontend_theme' => Yii::t('app', 'Frontend Theme'),
            'reset_username' => Yii::t('app', 'Reset Username'),
            'reset_password' => Yii::t('app', 'Reset Password'),
            'empty_username' => Yii::t('app', 'Empty Username'),
            'empty_password' => Yii::t('app', 'Empty Password'),
            'purchase_account' => Yii::t('app', 'Purchase Account'),
            'cash_purchase_account' => Yii::t('app', 'Cash Purchase Account'),
            'credit_purchase_account' => Yii::t('app', 'Credit Purchase Account'),
            'sale_account' => Yii::t('app', 'Sale Account'),
            'cash_sale_account' => Yii::t('app', 'Cash Sale Account'),
            'credit_sale_account' => Yii::t('app', 'Credit Sale Account'),
            'expense_account' => Yii::t('app', 'Expense Account'),
            'income_account' => Yii::t('app', 'Income Account'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicePrinter() {
        return $this->hasOne(Printer::className(), ['id' => 'invoice_printer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiptPrinter() {
        return $this->hasOne(Printer::className(), ['id' => 'receipt_printer']);
    }

}
