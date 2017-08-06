<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "account_group".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property AccountCategory[] $accountCategories
 */
class AccountGroup extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account_group';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 4],
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
        $map = ArrayHelper::map(AccountGroup::find()->orderBy([$value => SORT_ASC])->all(), 'id', $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Data Kategori Akun masih kosong. Segera tambahkan untuk menggunakan'));
        }
        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCategories() {
        return $this->hasMany(AccountCategory::className(), ['group_id' => 'id']);
    }

}
