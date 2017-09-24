<?php

namespace frontend\controllers;

use frontend\models\SalesDetail;
use frontend\models\SalesReturnDetail;
use Yii;
use frontend\models\SalesReturn;
use frontend\models\SalesReturnSearch;
use frontend\models\SalesDetailInternal;
use backend\models\RMedicine;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Sales;
use yii\helpers\Json;

/**
 * SalesReturnController implements the CRUD actions for SalesReturn model.
 */
class SalesReturnController extends Controller
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
     * Lists all SalesReturn models.
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new SalesReturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all SalesReturn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesReturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesReturn model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new SalesReturn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalesReturn();
        $invoiceList = Sales::customMap();
        $itemList = [];

        if ($model->load(Yii::$app->request->post()) && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Retur Penjualan Berhasil Disimpan.'));
            return $this->redirect(['index']);
        } else {
            $model->sr_date = time();
            $model->sr_return_number = $model->getInvoiceNumber();
            return $this->render('create', [
                'model' => $model,
                'invoiceList' => $invoiceList,
                'itemList' => $itemList,
            ]);
        }
    }

    /**
     * Updates an existing SalesReturn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $invoiceList = Sales::customMap();
        $itemList = Sales::getSalesItemList($model->sales_id, true);

        if ($model->load(Yii::$app->request->post()) && $model->saveTransactional()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Retur Penjualan Berhasil Diubah.'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'invoiceList' => $invoiceList,
                'itemList' => $itemList,
            ]);
        }
    }

    public function actionAjaxItemList()
    {
        $requestData = Yii::$app->request->post();
        $data = Sales::getSalesItemList($requestData['sales_id']);
        $buyerName = Sales::find()->where(['id' => $requestData['sales_id']])->one()->s_buyer;

        if (!empty($data)) {
            return Json::encode(['itemList' => $data, 'buyerName' => $buyerName]);
        }
        return Json::encode(false);
    }

    public function actionAjaxSalesDetail()
    {
        $requestData = Yii::$app->request->post();
        $item = SalesDetail::find()->where(['id' => $requestData['sales_detail_id']])->one();
        $data[] = [
            'price' => $item->item->i_sell_price,
            'quantity' => $item->sd_quantity,
            'discount' => is_null($item->sd_discount) ? "0" : $item->sd_discount,
        ];

        if (!empty($data)) {
            return Json::encode(['item' => $data]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemDetail()
    {
        $requestData = Yii::$app->request->post();
        $item = SalesDetail::find()->where(['id' => $requestData['sales_detail_id']])->one();

        $sales = $item->sales;
        $map = [];
        if (empty($sales->salesTypes)) {
            $map[] = [
                'id' => $item->id,
                'name' => $item->item->i_name,
            ];
        } else {
            $salesInternal = SalesDetailInternal::find()->where(['sales_detail_id' => $item->id])->one();
            $rMedicine = RMedicine::find()->where(['id' => $salesInternal->r_medicine_id])->one();
            $map[] = [
                'id' => $item->id,
                'name' => sprintf("%s %s >>  %s(%s X %s) >>  %s", $rMedicine->item->i_blended == 1 ? "(RACIKAN)" : "", $rMedicine->item->i_name, $rMedicine->rmr_amount, $rMedicine->rmr_dosage_1, $rMedicine->rmr_dosage_2, $rMedicine->rmr_dosage_3, $rMedicine->rmr_ref),
            ];
        }
        if (!empty($map)) {
            return Json::encode(['item' => $map]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemRow()
    {
        $requestData = Yii::$app->request->post();
        $item = SalesDetail::find()->where(['id' => $requestData['sales_detail_id']])->one();

        $sales = $item->sales;
        $map = [];
        $total = 0;
        $type = 0;
        if (empty($sales->salesTypes)) {
            $map[] = [
                'id' => $item->id,
                'name' => $item->item->i_name,
                'price' => $item->item->i_sell_price * (1 - ($item->sd_discount / 100)),
                'quantity' => $item->sd_quantity,
                'total' => $item->item->i_sell_price * (1 - ($item->sd_discount / 100)) * $item->sd_quantity,
            ];
            $type = 1;
        } else {
            $salesInternal = SalesDetailInternal::find()->where(['sales_detail_id' => $item->id])->one();
            $rMedicine = RMedicine::find()->where(['id' => $salesInternal->r_medicine_id])->one();
            $rmDetails = $rMedicine->rmDetails;
            $priceTotal = 0;
            $detail = [];
            if ($rMedicine->item->i_blended == 1) {
                foreach ($rmDetails as $key => $value) {
                    $priceTotal += $value->rmd_amount * $value->item->i_blend_price;
                    $detail[] = [
                        'detailName' => $value->item->i_name . " >> " . $value->rmd_amount . " x Rp. " . number_format($value->item->i_blend_price, 0, '.', ',') . " = Rp. " . number_format($value->rmd_amount * $value->item->i_blend_price, 0, '.', ','),
                    ];
                }
            }else{
                $priceTotal = $item->item->i_sell_price;
            }

            $map[] = [
                'id' => $item->id,
                'name' => $item->item->i_name,
                'price' => $priceTotal,
                'quantity' => $item->sd_quantity,
                'detail' => $detail,
                'total' => $item->sd_quantity * $priceTotal,
            ];
            $type = 2;
        }
        if (!empty($map)) {
            return Json::encode(['item' => $map, 'type' => $type]);
        }
        return Json::encode(false);
    }

    public function actionAjaxSalesReturnDetailDelete()
    {
        $requestData = Yii::$app->request->post();
        $id = $requestData['id'];
        if (SalesReturnDetail::find()->where(['id' => $id])->one()->delete()) {
            return Json::encode(true);
        }

        return Json::encode(false);
    }

    /**
     * Deletes an existing SalesReturn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'SalesReturn successfully deleted.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the SalesReturn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesReturn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesReturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
