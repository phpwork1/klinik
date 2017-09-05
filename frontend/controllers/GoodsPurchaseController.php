<?php

namespace frontend\controllers;

use frontend\models\GpDetail;
use frontend\models\Item;
use frontend\models\Supplier;
use Yii;
use frontend\models\GoodsPurchase;
use frontend\models\GoodsPurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * GoodsPurchaseController implements the CRUD actions for GoodsPurchase model.
 */
class GoodsPurchaseController extends Controller
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
    * Lists all GoodsPurchase models.
    * @return mixed
    */
    public function actionReport()
    {
        $searchModel = new GoodsPurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all GoodsPurchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsPurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new GoodsPurchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsPurchase();
        $addItemModel = new Item();
        $addSupplierModel = new Supplier();

        $gpDetailModel = new GpDetail();

        $requestData = Yii::$app->request->post();

        if ($model->load($requestData)  && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchase successfully created.'));
            return $this->redirect(['index']);
            } else {
            $model->gp_date = time();
            $model->gp_due_date = time();
            $model->gp_invoice_number = $model->getInvoiceNumber();
            return $this->render('create', [
                'model' => $model,
                'gpDetailModel' => $gpDetailModel,
                'addItemModel' => $addItemModel,
                'addSupplierModel' => $addSupplierModel,
            ]);
        }
    }

    public function actionAjaxItemDetail()
    {
        $requestData = Yii::$app->request->post();
        $item = Item::find()->where(['id' => $requestData['item_id']])->one();
        if (!empty($item)) {
            return Json::encode(['item' => $item]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemDetailDelete() {
        $requestData = Yii::$app->request->post();
        $id = $requestData['id'];
        if (GpDetail::find()->where(['id' => $id])->one()->delete()) {
            return Json::encode(true);
        }

        return Json::encode(false);
    }

    public function actionAjaxSaveItem(){
        $item = new Item();
        if(!$item->load(Yii::$app->request->post()) || !$item->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxSaveSupplier(){
        $supplier = new Supplier();
        if(!$supplier->load(Yii::$app->request->post()) || !$supplier->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    /**
     * Updates an existing GoodsPurchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $addItemModel = new Item();
        $addSupplierModel = new Supplier();

        $gpDetailModel = new GpDetail();

        $requestData = Yii::$app->request->post();

        if ($model->load($requestData)  && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchase successfully updated.'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'gpDetailModel' => $gpDetailModel,
                'addItemModel' => $addItemModel,
                'addSupplierModel' => $addSupplierModel,
            ]);
        }
    }

    /**
     * Deletes an existing GoodsPurchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchase successfully deleted.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the GoodsPurchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsPurchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsPurchase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
