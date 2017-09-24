<?php

namespace backend\controllers;

use Yii;
use backend\models\ClinicalAction;
use backend\models\ClinicalActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClinicalActionController implements the CRUD actions for ClinicalAction model.
 */
class ClinicalActionController extends Controller
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
    * Lists all ClinicalAction models.
    * @return mixed
    */
    public function actionReport()
    {
        $searchModel = new ClinicalActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all ClinicalAction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClinicalActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClinicalAction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new ClinicalAction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClinicalAction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Data Praktik Klinik Berhasil Disimpan.'));
            return $this->redirect(['view', 'id' => $model->id]);
            } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing ClinicalAction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Data Praktik Klinik Berhasil Diubah.'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing ClinicalAction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'Data Praktik Klinik Berhasil Dihapus.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the ClinicalAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClinicalAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClinicalAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
