<?php

namespace frontend\controllers;

use backend\models\Person;
use backend\models\Role;
use backend\models\User;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => ['class' => '\common\components\AccessRule'],
                'only' => ['logout', 'login', 'index', 'register'],
                'rules' => [
                    [
                        'actions' => ['register', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMINISTRATOR,
                            User::ROLE_CHAIRMAN,
                            User::ROLE_DEPUTY_CHAIRMAN,
                            User::ROLE_SECRETARY,
                            User::ROLE_TREASURER,
                            User::ROLE_TRANSPORTATION,
                            User::ROLE_ACCOMMODATION,
                            User::ROLE_IT,
                            User::ROLE_CONTACT_PERSON,
                            User::ROLE_PARTICIPANT
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (empty(Yii::$app->user->id)) {
            return $this->redirect(['login']);
        } else {
            return $this->render('index');
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index');
            //return $this->goBack();
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Person();
        $model->role = User::ROLE_PARTICIPANT;
        $model->setScenario(Person::SCENARIO_REGISTER);

        if ($model->load(Yii::$app->request->post()) && $model->transactionSave()) {
            $user = User::findOne(['person_id' => $model->id]);
            $email = \Yii::$app->mailer->compose()
                ->setTo($model->email)
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                ->setSubject('Signup Confirmation')
                ->setTextBody("Click this link " . \yii\helpers\Html::a('confirm',
                        Yii::$app->urlManager->createAbsoluteUrl(
                            ['site/confirm', 'id' => $user->id, 'key' => $user->auth_key]
                        ))
                )
                ->send();
            if ($email) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for Activation code.'));
            } else {
                Yii::$app->session->setFlash('warning', Yii::t('app', 'Fail to send email. Contact Tonny on tonny.chua@gmail.com or 08192588008'));
            }
            return $this->redirect(['site/login']);
        } else {
            return $this->render('register', ['model' => $model]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionConfirm($id, $key)
    {
        $user = \common\models\User::find()->where([
            'id' => $id,
            'auth_key' => $key,
            'status' => 0,
        ])->one();
        if (!empty($user)) {
            $user->status = 10;
            $user->save();
            Yii::$app->getSession()->setFlash('success', 'Success! Now you can login with your email and password');
        } else {
            Yii::$app->getSession()->setFlash('warning', 'Failed! Contact tonny.chua@gmail.com or +62 819 258 8008');
        }
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
