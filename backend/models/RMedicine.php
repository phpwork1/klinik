<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use frontend\models\Item;
use common\components\helpers\AppConst;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "r_medicine".
 *
 * @property integer $id
 * @property integer $registration_id
 * @property integer $item_id
 * @property integer $rmr_amount
 * @property string $rmr_dosage_1
 * @property string $rmr_dosage_2
 * @property string $rmr_dosage_3
 * @property string $rmr_ref
 * @property RMedicine[] $map
 *
 * @property Item $item
 * @property Registration $registration
 * @property RmDetail[] $rmDetails
 */
class RMedicine extends \yii\db\ActiveRecord
{
    public $dosage_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_medicine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_id', 'item_id', 'rmr_amount'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['registration_id', 'item_id', 'rmr_amount'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['rmr_ref'], 'string'],
            [['rmr_dosage_1', 'rmr_dosage_2', 'rmr_dosage_3'], 'string', 'max' => 20],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registration::className(), 'targetAttribute' => ['registration_id' => 'id']],
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
            'item_id' => 'Obat',
            'rmr_amount' => 'Jumlah',
            'rmr_dosage_1' => 'Dosis',
            'rmr_dosage_2' => 'Dosis',
            'rmr_dosage_3' => 'Dosis',
            'rmr_ref' => 'Keterangan',
        ];
    }

    public function afterFind() {
        parent::afterFind();

        $this->dosage_name = sprintf("%s X %s %s", $this->rmr_dosage_1, $this->rmr_dosage_2, $this->rmr_dosage_3);

        return true;
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
    public static function getAll($value = 'id', $conditions = null) {
        $query = RMedicine::find()->orderBy(['id' => SORT_ASC]);

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
    public static function map($key = 'id', $value = 'id', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'id' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        return $map;
    }

    public static function getItemNameById($id){
        return Item::find()->where(['id' => $id])->one()->i_name;
    }

    public static function mapWithItem($key = 'id', $value = 'id', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'id' : $value;
        $map = ArrayHelper::map(RMedicine::find()->joinWith(['item i'])->andWhere(is_null($conditions) ? null : $conditions)->all(), $key, $value);
        foreach($map as $key => $value){
            $map[$key] = self::getItemNameById($value);
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
    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['id' => 'registration_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmDetails()
    {
        return $this->hasMany(RmDetail::className(), ['r_medicine_id' => 'id']);
    }
}
