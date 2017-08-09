<?php

namespace backend\models;

use Imagine\Image\Box;
use Yii;
use yii\helpers\ArrayHelper;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $role
 * @property string $old_password
 * @property string $password
 * @property string $confirm_password
 * @property string $address
 * @property string $regency
 * @property string $province
 * @property integer $country
 * @property string $birth_date
 * @property string $gender
 * @property string $religion
 * @property string $marriage_status
 * @property string $nationality
 * @property string $educational_level
 * @property string $dicipline
 * @property string $profession
 * @property string $majoring
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $whatsapp
 * @property string $fb
 * @property string $bbm
 * @property string $line
 * @property string $skype
 * @property string $emergency_contact_name
 * @property string $emergency_contact_number
 * @property string $photo
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class Person extends \yii\db\ActiveRecord
{
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CHANGE_PASSWORD = 'change-password';

    public $image;
    public $directory = 'uploads/people';
    public $old_password;
    public $password;
    public $password_repeat;
    public $role;
    public $captcha;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_REGISTER] = ['name', 'address', 'birth_date', 'gender', 'religion', 'marriage_status', 'nationality', 'country', 'province', 'regency', 'educational_level', 'dicipline', 'profession', 'majoring', 'email', 'mobile', 'phone', 'password', 'password_repeat', 'emergency_contact_name', 'emergency_contact_number'];
        $scenarios[self::SCENARIO_CHANGE_PASSWORD] = ['password', 'password_repeat'];
        return $scenarios;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'birth_date', 'gender', 'religion', 'marriage_status', 'nationality', 'country', 'province', 'regency', 'educational_level', 'dicipline', 'profession', 'majoring', 'email', 'mobile', 'emergency_contact_name', 'emergency_contact_number'], 'required'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['password'], 'string', 'max' => 50],
            [['name', 'address'], 'string', 'max' => 128],
            [['regency', 'province', 'country', 'phone'], 'string', 'max' => 36],
            [['birth_date'], 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique'],
            [['gender', 'marriage_status'], 'string', 'max' => 12],
            [['religion', 'nationality'], 'string', 'max' => 24],
            [['educational_level', 'dicipline', 'profession', 'majoring', 'email', 'mobile', 'phone', 'whatsapp', 'fb', 'bbm', 'line', 'skype', 'emergency_contact_name', 'emergency_contact_number'], 'string', 'max' => 36],
            [['photo'], 'string', 'max' => 72],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'minWidth' => 100, 'minHeight' => 100],
            ['captcha', 'captcha', 'on' => self::SCENARIO_REGISTER],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'regency' => Yii::t('app', 'Regency'),
            'province' => Yii::t('app', 'Province'),
            'country' => Yii::t('app', 'Country'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'gender' => Yii::t('app', 'Gender'),
            'religion' => Yii::t('app', 'Religion'),
            'marriage_status' => Yii::t('app', 'Marriage Status'),
            'nationality' => Yii::t('app', 'Nationality'),
            'educational_level' => Yii::t('app', 'Educational Level'),
            'dicipline' => Yii::t('app', 'Dicipline'),
            'profession' => Yii::t('app', 'Profession'),
            'majoring' => Yii::t('app', 'Majoring'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'phone' => Yii::t('app', 'Phone'),
            'whatsapp' => Yii::t('app', 'WhatsApp'),
            'fb' => Yii::t('app', 'Facebook'),
            'bbm' => Yii::t('app', 'BBM'),
            'line' => Yii::t('app', 'Line'),
            'skype' => Yii::t('app', 'Skype'),
            'emergency_contact_name' => Yii::t('app', 'Emergency Contact'),
            'emergency_contact_number' => Yii::t('app', 'Emergency No'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created'),
            'created_by' => Yii::t('app', 'By'),
            'updated_at' => Yii::t('app', 'Updated'),
            'updated_by' => Yii::t('app', 'By'),
            'deleted_at' => Yii::t('app', 'Deleted'),
            'deleted_by' => Yii::t('app', 'By'),
        ];
    }

    /**
     * @return \yii\behaviors\TimestampBehavior
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_DELETE => ['deleted_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_by = Yii::$app->user->id;
        } else {
            $this->updated_by = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        $this->deleted_by = Yii::$app->user->id;
        return parent::beforeDelete();
    }

    /**
     * Return model objects
     * @param string $value default to 'name'
     * @param string $conditions default to null
     * @return \yii\db\ActiveQuery
     */
    public static function getAll($value = 'name', $conditions = null)
    {
        $query = Person::find()->orderBy([$value => SORT_ASC]);
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
     * @return Array
     */
    public static function map($key = 'id', $value = 'name', $conditions = null)
    {
        $key = empty($key) ? 'id' : $key;
        $value = empty($value) ? 'name' : $value;
        $map = ArrayHelper::map(self::getAll($value, $conditions), $key, $value);
        if (empty($map)) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Person database still empty. Please add the data as soon as possible.'));
        }
        return $map;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }


    public function getPicture()
    {
        if (!empty($this->photo)) {
            $url = Yii::$app->homeUrl . '/../../../backend/web/' . $this->directory . '/' . $this->photo;
            $options = ['escape' => false, 'title' => 'open file ' . $this->photo, 'target' => 'blank'];
            return Html::a(Yii::t('app', '[show photo]'), $url, $options);
        } else {
            return null;
        }
    }

    /**
     * @return bool save order data. return true if success, false if fail
     * @throws \Exception
     * @internal param Yii $array ::$app->request->post() POST data
     */
    public function transactionSave()
    {
        $transaction = Person::getDb()->beginTransaction();
        $clean[] = TRUE;

        try {
            // UPLOAD FILE TO DESTINED FOLDER
            $file = UploadedFile::getInstance($this, 'image');
            $ext = empty($file) ? 'png' : $file->extension;
            if (empty($this->photo)) {
                $this->photo = uniqid('', true) . '.' . $ext;
            }

            ## SAVE DATA
            $clean[] = $this->save() !== FALSE;

            if ($this->getScenario() == self::SCENARIO_REGISTER) {
                ## REGISTER USER
                $user = User::findByEmail($this->email);
                if ($user) {
                    Yii::$app->session->addFlash('danger', Yii::t('app', 'This email have been registered.'));
                } else {
                    $user = new User();
                    $user->username = $this->name;
                    $user->role = $this->role;
                    $user->email = $this->email;
                    $user->status = User::STATUS_DELETED;
                    $user->setPassword($this->password);
                    $user->generateAuthKey();
                    $user->person_id = $this->id;
                    $clean[] = $user->save() !== false;
                }
            }

            if (!in_array(FALSE, $clean)) {
                $filename = Yii::getAlias('@backend') . '/web/' . $this->directory . '/' . $this->photo;
                $thumbnail = Yii::getAlias('@backend') . '/web/' . $this->directory . '/thumb-' . $this->photo;
                if (!empty($file)) {
                    $file->saveAs($filename);
                    //Image::frame($this->directory . '/' . $this->photo)->thumbnail(new Box(280, 280))->save($this->directory . '/' . $this->photo, ['quality' => 85]);
                } else {
                    copy(Yii::getAlias('@backend') . '/web/nophoto.png', Yii::getAlias('@backend') . '/web/' . $this->directory . '/' . $this->photo);
                }
                Image::thumbnail($filename, 60, 80)->save($thumbnail);
                Image::getImagine()->open($filename)->thumbnail(new Box(280, 280))->save($filename, ['quality' => 85]);
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
     * @return bool save order data. return true if success, false if fail
     * @throws \Exception
     * @internal param Yii $array ::$app->request->post() POST data
     */
    public function transactionChangePassword()
    {
        $transaction = Person::getDb()->beginTransaction();
        $clean[] = TRUE;

        try {
            ## COMPARE OLD PASSWORD
//            $user = new User();
//            $user->setPassword($this->old_password);
//            echo Yii::$app->user->identity->password_hash , '<br>';
//            echo $user->password_hash;exit;
//            if (Yii::$app->user->identity->password_hash != $user->password_hash) {
//                $clean[] = false;
//                Yii::$app->session->addFlash('danger', Yii::t('app', Yii::t('app', 'Old password doesn\'t match')));
//            } else {
//                ## SAVE DATA
//                $clean[] = $this->save() !== FALSE;
//            }

            $user = User::findByEmail($this->email);
            if ($user) {
                $user->setPassword($this->password);
                $clean[] = $user->save() !== false;
            }

            if (!in_array(FALSE, $clean)) {
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
     * Delete order step by step, update product stock
     * @return bool delete order data. return true if success, false if fail
     * @throws \Exception
     * @internal param int $id
     */
    public function transactionDelete()
    {
        $transaction = Person::getDb()->beginTransaction();
        $clean[] = TRUE;

        try {
            ## DELETE DETAIL DATA
            foreach ($this->orderDetails as $orderDetail) {
                $clean[] = $orderDetail->transactionDelete() !== FALSE;
            }

            ## DELETE DATA
            $clean[] = $this->delete() !== FALSE;

            if (!in_array(FALSE, $clean)) {
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

}
