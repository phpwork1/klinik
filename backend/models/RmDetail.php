<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;
use frontend\models\Item;
use common\components\helpers\AppConst;


/**
 * This is the model class for table "rm_detail".
 *
 * @property integer $id
 * @property integer $registration_id
 * @property integer $r_medicine_id
 * @property integer $item_id
 * @property integer $rmd_amount
 * @property RmDetail[] $map
 *
 * @property Item $item
 * @property RMedicine $rMedicine
 * @property Registration $registration
 */
class RmDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_id', 'r_medicine_id', 'item_id', 'rmd_amount'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['registration_id', 'r_medicine_id', 'item_id', 'rmd_amount'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['r_medicine_id'], 'exist', 'skipOnError' => true, 'targetClass' => RMedicine::className(), 'targetAttribute' => ['r_medicine_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode',
            'registration_id' => 'Registrasi',
            'r_medicine_id' => 'Obat',
            'item_id' => 'Bahan Racikan',
            'rmd_amount' => 'Jumlah',
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
    public static function getAll($value = 'name', $conditions = null) {
        $query = RmDetail::find()->orderBy([$value => SORT_ASC]);
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
            Yii::$app->session->setFlash('danger', Yii::t('app', 'RmDetail database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRMedicine()
    {
        return $this->hasOne(RMedicine::className(), ['id' => 'r_medicine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['id' => 'registration_id']);
    }
}
