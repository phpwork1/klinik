<?php

namespace backend\controllers;

use Yii;
use backend\models\Parameter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use backend\models\Printer;

/**
 * ParameterController implements the CRUD actions for Parameter model.
 */
class ParameterController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => ['class' => '\common\components\AccessRule'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'set-printer'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR, User::ROLE_CHAIRMAN],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Parameter models.
     * @return mixed
     */
    public function actionIndex() {
//        $userId = Yii::$app->user->id;
//        echo Yii::$app->user->id;
//        echo Yii::$app->authManager->getRoles();
        return $this->render('index', ['model' => $this->findModel(1)]);
    }

    /**
     * Updates an existing Parameter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Setting berhasil diubah. Anda perlu masuk kembali ke program agar setting teraplikasikan.');
            Yii::$app->user->logout();
            return $this->goHome();
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionSetPrinter() {
        $model = $this->findModel(1);
        $model['scenario'] = 'printer';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data penggunaan printer berhasil diubah. Anda perlu masuk kembali ke program agar setting teraplikasikan.');
            Yii::$app->user->logout();
            return $this->goHome();
        } else {
            return $this->render('set-printer', ['model' => $model]);
        }
    }

    /**
     * Finds the Parameter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parameter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Parameter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
