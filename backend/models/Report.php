<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "account".
 *
 * @property date $date
 * @property date $fdate
 * @property date $tdate
 *
 * @property AccountCategory $category
 */
class Report extends Model {
    
    public $date;
    public $fdate;
    public $tdate;
    public $month;
    public $year;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fdate', 'tdate', 'date', 'month', 'year'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'month' => Yii::t('app', 'Bulan'),
            'year' => Yii::t('app', 'Tahun'),
            'date' => Yii::t('app', 'Tanggal'),
            'fdate' => Yii::t('app', 'Dari Tanggal'),
            'tdate' => Yii::t('app', 'Sampai Tanggal'),
        ];
    }

}
