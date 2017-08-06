<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "account_category".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $code
 * @property string $name
 *
 * @property Account[] $accounts
 * @property AccountGroup $group
 */
class AccountCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account_category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['group_id', 'code', 'name'], 'required'],
            [['group_id'], 'integer'],
            [['code'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group'),
            'code' => Yii::t('app', 'Kode'),
            'name' => Yii::t('app', 'Nama'),
        ];
    }

    /**
     * Return array of key => value for dropdown menu
     * @param string $value default to 'name'
     * @return \yii\db\ActiveQuery
     */
    public static function map($value = 'name') {
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(AccountCategory::find()->orderBy([$value => SORT_ASC])->all(), 'id', $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Data Kategori Akun masih kosong. Segera tambahkan untuk menggunakan'));
        }
        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts() {
        return $this->hasMany(Account::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup() {
        return $this->hasOne(AccountGroup::className(), ['id' => 'group_id']);
    }

}
