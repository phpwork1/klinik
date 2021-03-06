<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => ['class' => '\common\components\AccessRule'],
                'rules' => [
                    [
                        'actions' => ['report', 'index', 'view', 'create', 'update', 'delete', 'toggle-status'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'toggle-user' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */

    public function actionReport()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            Yii::$app->session->setFlash('success', 'Data user berhasil disimpan.');
            return $this->redirect(['index', 'UserSearch[username]' => $model->username]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\NotSupportedException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        d(Yii::$app->request->post());exit;

        // CHECK THIS USER ROLE. IF < TARGET ROLE, DENIED
        if (Yii::$app->user->identity->role <= $model->role) {
            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                Yii::$app->session->setFlash('success', 'Data user berhasil diubah.');
                return $this->redirect(['index', 'UserSearch[username]' => $model->username]);
            } else {
                return $this->render('update', ['model' => $model]);
            }
        } else {
            throw new \yii\base\NotSupportedException('The requested user have higher role than you.');
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\NotSupportedException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // CHECK THIS USER ROLE. IF < TARGET ROLE, DENIED
        if (Yii::$app->user->identity->role <= $model->role) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Data user berhasil dihapus.');
            return $this->redirect(['index', 'UserSearch[gtrole]' => Yii::$app->user->identity->role]);
        } else {
            throw new \yii\base\NotSupportedException('The requested user have higher role than you.');
        }



    }

    public function actionToggleStatus($id)
    {
        $model = $this->findModel($id);

        // CHECK THIS USER ROLE. IF < TARGET ROLE, DENIED
        if (Yii::$app->user->identity->role <= $model->role) {
            $model->status = $model->status == 0 ? 10 : 0;
            $model->save();
            Yii::$app->session->setFlash('success', 'Data user berhasil diubah.');
            return $this->redirect(['index', 'UserSearch[username]' => $model->username]);
        } else {
            throw new \yii\base\NotSupportedException('The requested user have higher role than you.');
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
