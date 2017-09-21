<?php

namespace frontend\controllers;

use frontend\models\GoodsPurchase;
use frontend\models\GoodsPurchaseReturnDetail;
use frontend\models\GpDetail;
use Yii;
use frontend\models\GoodsPurchaseReturn;
use frontend\models\GoodsPurchaseReturnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * GoodsPurchaseReturnController implements the CRUD actions for GoodsPurchaseReturn model.
 */
class GoodsPurchaseReturnController extends Controller
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
     * Lists all GoodsPurchaseReturn models.
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new GoodsPurchaseReturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all GoodsPurchaseReturn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsPurchaseReturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoodsPurchaseReturn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new GoodsPurchaseReturn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsPurchaseReturn();
        $invoiceList = GoodsPurchase::map('id', 'gp_invoice_number');
        $itemList = [];

        if ($model->load(Yii::$app->request->post()) && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchaseReturn successfully created.'));
            return $this->redirect(['index']);
        } else {
            $model->gpr_date = time();
            $model->gpr_return_number = $model->getInvoiceNumber();
            return $this->render('create', [
                'model' => $model,
                'invoiceList' => $invoiceList,
                'itemList' => $itemList,
            ]);
        }
    }

    /**
     * Updates an existing GoodsPurchaseReturn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $invoiceList = GoodsPurchase::map('id', 'gp_invoice_number');
        $itemList = GpDetail::dropdownItemMap($model->goods_purchase_id);

        if ($model->load(Yii::$app->request->post()) && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchaseReturn successfully updated.'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'invoiceList' => $invoiceList,
                'itemList' => $itemList,
            ]);
        }
    }

    /**
     * Deletes an existing GoodsPurchaseReturn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'GoodsPurchaseReturn successfully deleted.'));
        return $this->redirect(['index']);
    }

    public function actionAjaxItemList()
    {
        $requestData = Yii::$app->request->post();
        $goodsPurchase = GoodsPurchase::find()->where(['id' => $requestData['goods_purchase_id']])->one();
        $itemList = GpDetail::find()->where(['goods_purchase_id' => $requestData['goods_purchase_id']])->all();
        $data = [];
        foreach ($itemList as $key => $value) {
            $data[] = [
                'id' => $value->id,
                'name' => sprintf("%s | %s", $value->item->i_name, $value->gpd_price),
            ];
        }
        $supplierName = $goodsPurchase->supplier->s_name;
        if (!empty($data)) {
            return Json::encode(['itemList' => $data, 'supplierName' => $supplierName]);
        }
        return Json::encode(false);
    }

    public function actionAjaxGpDetail()
    {
        $requestData = Yii::$app->request->post();
        $item = GpDetail::find()->where(['id' => $requestData['gp_detail_id']])->one();
        if (!empty($item)) {
            return Json::encode(['item' => $item]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemDetail()
    {
        $requestData = Yii::$app->request->post();
        $item = GpDetail::find()->where(['id' => $requestData['gp_detail_id']])->one();
        $data[] = [
            'id' => $item->id,
            'name' => sprintf("%s | %s",$item->item->i_name, $item->gpd_price),
        ];
        if (!empty($data)) {
            return Json::encode(['item' => $data]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemRow()
    {
        $requestData = Yii::$app->request->post();
        $item = GpDetail::find()->where(['id' => $requestData['gp_detail_id']])->one();
        $data[] = [
            'id' => $item->id,
            'name' => $item->item->i_name,
            'price' => $item->gpd_price,
            'quantity' => $item->gpd_quantity,
        ];
        if (!empty($data)) {
            return Json::encode(['item' => $data]);
        }
        return Json::encode(false);
    }

    public function actionAjaxGoodsPurchaseReturnDetailDelete() {
        $requestData = Yii::$app->request->post();
        $id = $requestData['id'];
        if (GoodsPurchaseReturnDetail::find()->where(['id' => $id])->one()->delete()) {
            return Json::encode(true);
        }

        return Json::encode(false);
    }

    /**
     * Finds the GoodsPurchaseReturn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsPurchaseReturn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsPurchaseReturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
