<?php

namespace backend\controllers;

use Yii;
use backend\models\PracticeAction;
use backend\models\PracticeActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PracticeActionController implements the CRUD actions for PracticeAction model.
 */
class PracticeActionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Lists all PracticeAction models.
    * @return mixed
    */
    public function actionReport()
    {
        $searchModel = new PracticeActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all PracticeAction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PracticeActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PracticeAction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new PracticeAction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PracticeAction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'PracticeAction successfully created.'));
            return $this->redirect(['view', 'id' => $model->id]);
            } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing PracticeAction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'PracticeAction successfully updated.'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing PracticeAction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'PracticeAction successfully deleted.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the PracticeAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PracticeAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PracticeAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
