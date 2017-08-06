<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property integer $province_id
 * @property string $code
 * @property string $name
 * @property City[] $map
 *
 * @property Customer[] $customers
 * @property Province[] $province
 */
class City extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['province_id', 'code', 'name'], 'required'],
            [['province_id'], 'integer'],
            [['code'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 24]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'province_id' => Yii::t('app', 'Provinsi'),
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
        $map = ArrayHelper::map(City::find()->orderBy([$value => SORT_ASC])->all(), 'id', $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Data Kota masih kosong. Segera tambahkan untuk menggunakan'));
        }
        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers() {
        return $this->hasMany(Customer::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersList() {
        return ArrayHelper::map(Customer::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince() {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinceList() {
        return ArrayHelper::map(Province::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');
    }

}
