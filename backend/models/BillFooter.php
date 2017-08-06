<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bill_footer".
 *
 * @property integer $id
 * @property string $footer
 */
class BillFooter extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bill_footer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['footer'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'footer' => Yii::t('app', 'Footer'),
        ];
    }

}
