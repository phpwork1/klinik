<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\helpers\AppConst;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\db\Exception;

//use yii\db\Expression;
//use yii\behaviors\TimestampBehavior;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $s_name
 * @property string $s_address
 * @property integer $s_phone_number
 * @property string $s_contact_person
 * @property string $s_file
 */
class Supplier extends \yii\db\ActiveRecord
{
    public $directory = 'uploads/supplier';
    public $oldSFile;
    /**
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 's_address', 's_phone_number', 's_contact_person'], 'required', 'message' => AppConst::VALIDATE_REQUIRED],
            [['s_address'], 'string'],
            [['s_phone_number'], 'integer', 'message' => AppConst::VALIDATE_INTEGER],
            [['s_name', 's_contact_person'], 'string', 'max' => 50],
            [['s_file'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Kode'),
            's_name' => Yii::t('app', 'Nama Suplier'),
            's_address' => Yii::t('app', 'Alamat'),
            's_phone_number' => Yii::t('app', 'Telp.'),
            's_contact_person' => Yii::t('app', 'Contact Person'),
            's_file' => Yii::t('app', 'File'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->oldSFile = $this->s_file;

        return true;
    }

    public function beforeDelete()
    {
        if(!empty($this->oldSFile)){
            unlink(Yii::getAlias('@frontend') . '/web/' . $this->directory . '/' . $this->oldSFile);
        }

        return parent::beforeDelete();
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

    public function getFile()
    {
        if (!empty($this->s_file)) {
            $url = Yii::$app->homeUrl . '/../../../frontend/web/' . $this->directory . '/' . $this->s_file;
            $options = ['escape' => false, 'title' => 'open file ' . $this->s_file, 'target' => 'blank'];
            return Html::a(Yii::t('app', '[show file]'), $url, $options);
        } else {
            return null;
        }
    }

    /**
     * @return bool save order data. return true if success, false if fail
     * @throws \Exception
     * @internal param Yii $array ::$app->request->post() POST data
     */
    public function saveTransactional()
    {
        $transaction = Supplier::getDb()->beginTransaction();
        $clean[] = TRUE;

        try {
            // UPLOAD FILE TO DESTINED FOLDER
            $file = UploadedFile::getInstance($this, 's_file');
            $ext = empty($file) ? 'xlsx' : $file->extension;
            if (empty($this->s_file)) {
                if(empty($file)){
                    $this->s_file = "";
                }else {
                    $this->s_file = uniqid('', true) . '.' . $ext;
                }
            }

            ## SAVE DATA
            $clean[] = $this->save() !== FALSE;

            if (!in_array(FALSE, $clean)) {
                $filename = Yii::getAlias('@frontend') . '/web/' . $this->directory . '/' . $this->s_file;
                if (!empty($file)) {
                    if(!empty($this->oldSFile)){
                        unlink(Yii::getAlias('@frontend') . '/web/' . $this->directory . '/' . $this->oldSFile);
                    }
                    $file->saveAs($filename);
                    //Image::frame($this->directory . '/' . $this->photo)->thumbnail(new Box(280, 280))->save($this->directory . '/' . $this->photo, ['quality' => 85]);
                }else{
                    unlink(Yii::getAlias('@frontend') . '/web/' . $this->directory . '/' . $this->oldSFile);
                }
                $transaction->commit();
                return TRUE;
            } else {
                foreach ($this->errors as $attr => $errors) {
                    $error = join('<br />', $errors);
                    Yii::$app->session->addFlash('danger', Yii::t('app', $error));
                }
                return FALSE;
            }
        } catch (Exception $ex) {
            $transaction->rollBack();
            throw($ex);
        }
    }
    
    /**
    * Return model objects
    * @param string $value default to 'name'
    * @param string $conditions default to null
    * @return \yii\db\ActiveRecord[]
    */
    public static function getAll($value = 's_name', $conditions = null) {
        $query = Supplier::find()->orderBy([$value => SORT_ASC]);
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
    public static function map($key = 'id', $value = 's_name', $conditions = null) {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Supplier database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }

}
