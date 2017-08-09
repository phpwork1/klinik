<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $role
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $password write-only password
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $person_id
 * @property integer $branch_id
 * @property User[] $map
 * 
 * @property Person[] $person
 */
class User extends ActiveRecord implements IdentityInterface {


    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    
    const ROLE_ADMINISTRATOR = 10;
    const ROLE_CHAIRMAN = 20;
    const ROLE_DEPUTY_CHAIRMAN = 30;
    const ROLE_SECRETARY = 40;
    const ROLE_TREASURER = 50;
    const ROLE_TRANSPORTATION = 60;
    const ROLE_ACCOMMODATION = 70;
    const ROLE_IT = 80;
    const ROLE_PUBLIC_RELATION = 90;
    const ROLE_CONTACT_PERSON = 90;
    const ROLE_PARTICIPANT = 1000;

    const LABEL_PARTICIPANT = 'Peserta';

    public $password;

    public $roles = [
        self::ROLE_ADMINISTRATOR => 'Administrator',
        self::ROLE_CHAIRMAN => 'Chairman',
        self::ROLE_DEPUTY_CHAIRMAN => 'Deputy Chairman',
        self::ROLE_SECRETARY => 'Secretary',
        self::ROLE_TREASURER => 'Treasurer',
        self::ROLE_TRANSPORTATION => 'Transportation',
        self::ROLE_ACCOMMODATION => 'Accommodation',
        self::ROLE_IT => 'IT',
        self::ROLE_PUBLIC_RELATION => 'Public Relation',
        self::ROLE_CONTACT_PERSON => 'Contact Person',
        self::ROLE_PARTICIPANT => 'Peserta',
    ];

    public static $allRoles = [
        self::ROLE_ADMINISTRATOR => 'Administrator',
        self::ROLE_CHAIRMAN => 'Chairman',
        self::ROLE_DEPUTY_CHAIRMAN => 'Deputy Chairman',
        self::ROLE_SECRETARY => 'Secretary',
        self::ROLE_TREASURER => 'Treasurer',
        self::ROLE_TRANSPORTATION => 'Transportation',
        self::ROLE_ACCOMMODATION => 'Accommodation',
        self::ROLE_IT => 'IT',
        self::ROLE_PUBLIC_RELATION => 'Public Relation',
        self::ROLE_CONTACT_PERSON => 'Contact Person',
        self::ROLE_PARTICIPANT => 'Peserta',
    ];

    public $statuses = [
        self::STATUS_ACTIVE=> 'Active',
        self::STATUS_DELETED => 'Inactive',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'message' => 'This email address has already been taken.'],
            //['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['person_id', 'required'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'person_id' => Yii::t('app', 'Peserta'),
            'branch_id' => Yii::t('app', 'Cabang'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Bagian'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Terdaftar'),
            'updated_at' => Yii::t('app', 'Diubah'),
            'roleName' => Yii::t('app', 'Jabatan'),
        ];
    }

    /**
     * @return \yii\behaviors\TimestampBehavior
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * Return array of key => value for dropdown menu
     * @param string $value default to 'name'
     * @return \yii\db\ActiveQuery
     */
    public static function map($value = 'username') {
        $value = empty($value) ? 'username' : $value;
        return ArrayHelper::map(User::find()->orderBy([$value => SORT_ASC])->all(), 'id', $value);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email) {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson() {
        if ($this->role < User::ROLE_PARTICIPANT) {
            return $this->hasOne(Person::className(), ['id' => 'person_id']);
        } else if ($this->role == User::ROLE_PARTICIPANT) {
            return $this->hasOne(Customer::className(), ['id' => 'person_id']);
        }
    }

    public function getPersonList() {
        if ($this->role < User::ROLE_PARTICIPANT) {
            return Person::map();
        } else if ($this->role == User::ROLE_PARTICIPANT) {
            return Customer::map();
        }
    }

    /**
     * @return \yii\helpers\Url
     */
    public function getPersonLink() {
        if (!empty($this->person->name)) {
            $url = Url::toRoute(['person/view', 'id' => $this->person_id]);
            $options = ['escape' => false, 'title' => 'Person', 'target' => 'blank'];
            return Html::a($this->person->name, $url, $options);
        } else {
            return null;
        }
    }

    public function getRoleName() {
        return $this->roles[$this->role];
    }
    public function getStatusName() {
        return $this->statuses[$this->status];
    }

    /**
     * Create New User
     * @return User|null the saved model or null if saving fails
     * @throws \Exception
     * @internal param Yii $array ::$app->request->post() POST data
     */
    public function signup() {
        $transaction = User::getDb()->beginTransaction();
        $clean[] = TRUE;

        try {
            ## LOAD AND SAVE
            if ($this->validate()) {
                if (!empty($this->password)) {
                    $this->setPassword($this->password);
                }
                $this->generateAuthKey();
                $clean[] = $this->save() !== FALSE;

                // the following three line is for RBAC
                //$auth = Yii::$app->authManager;
                //$role = $auth->getRole($this->role);
                //$auth->assign($role, $user->getId());
            } else {
                d($this->errors);exit;
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

        return null;
    }

}
