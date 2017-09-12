<?php

namespace frontend\controllers;

use backend\models\Registration;
use backend\models\RegistrationSearch;
use backend\models\RmDetail;
use backend\models\RMedicine;
use frontend\models\Item;
use Yii;
use frontend\models\Sales;
use frontend\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
/**
 * SalesController implements the CRUD actions for Sales model.
 */
class SalesController extends Controller
{
    public $type;

    const SALES_TYPE_EXTERNAL = 1;
    const SALES_TYPE_INTERNAL = 2;

    public $salesTypeList = [
        self::SALES_TYPE_EXTERNAL => 'External',
        self::SALES_TYPE_INTERNAL => 'Internal',
    ];

    public function getPaymentTypeName()
    {
        return $this->salesTypeList[$this->type];
    }

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

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        if (in_array($action->id, ['index', 'create', 'update', 'view'])) {
            $type = Yii::$app->request->get('type');
            if (empty($type)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

            $this->type = $type;
        }

        return TRUE;
    }

    /**
     * Lists all Sales models.
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all Sales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchRegistrationModel = null;
        $dataRegistrationProvider = null;

        if ($this->type == self::SALES_TYPE_INTERNAL) {
            $searchRegistrationModel = new RegistrationSearch();
            $dataRegistrationProvider = $searchRegistrationModel->searchCheckedUser(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'type' => $this->type,
            'title' => $this->getPaymentTypeName(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchRegistrationModel' => $searchRegistrationModel,
            'dataRegistrationProvider' => $dataRegistrationProvider,
        ]);
    }

    /**
     * Displays a single Sales model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Sales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sales();
        $registrationModel = null;
        $itemList = null;
        $allItem = Item::find()->all();

        if (!is_null(Yii::$app->request->get('registrationId'))) {
            $registrationModel = Registration::find()->where(['id' => Yii::$app->request->get('registrationId')])->one();
            $result = $registrationModel->rMedicines;
            foreach($result as $key => $value){
                $itemList[$value->id] = sprintf("%s %s >>  %s(%s X %s) >>  %s", $value->item->i_blended == 1 ? "(RACIKAN)" : "",$value->item->i_name,$value->rmr_amount, $value->rmr_dosage_1, $value->rmr_dosage_2, $value->rmr_dosage_3, $value->rmr_ref);
            }
        }else{
            $itemList = Item::map();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Sales successfully created.'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'allItem' => $allItem,
                'itemList' => $itemList,
                'model' => $model,
                'registrationModel' => $registrationModel,
                'type' => $this->type,
            ]);
        }
    }

    /**
     * Updates an existing Sales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Sales successfully updated.'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Sales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'Sales successfully deleted.'));
        return $this->redirect(['index']);
    }

    public function actionAjaxItemDetailExternal()
    {
        $requestData = Yii::$app->request->post();
        $item = Item::find()->where(['id' => $requestData['item_id']])->one();
        if (!empty($item)) {
            return Json::encode(['item' => $item]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemDetailInternal()
    {
        $requestData = Yii::$app->request->post();
        $rMedicine = RMedicine::find()->where(['id' => $requestData['rmedicine_id']])->one();
        $item = Item::find()->where(['id' => $rMedicine->item_id])->one();
        if (!empty($item)) {
            if(isset($requestData['format'])){
                $item->i_name = sprintf("%s %s >>  %s(%s X %s) >>  %s", $rMedicine->item->i_blended == 1 ? "(RACIKAN)" : "",$rMedicine->item->i_name,$rMedicine->rmr_amount, $rMedicine->rmr_dosage_1, $rMedicine->rmr_dosage_2, $rMedicine->rmr_dosage_3, $rMedicine->rmr_ref);
            }
            return Json::encode(['item' => $item]);
        }
        return Json::encode(false);
    }

    public function actionAjaxItemDetailInternalDetail()
    {
        $requestData = Yii::$app->request->post();
        $rMedicineid = $requestData['rmedicine_id'];

        $detail = Item::find()->select(['i_name', 'i_blend_price', 'rmd_amount'])->joinWith(['rmDetails rd'], true, 'INNER JOIN')->where(['rd.r_medicine_id' => $rMedicineid])->all();
        $amount = RmDetail::find()->where(['r_medicine_id' => $rMedicineid])->all();

        return Json::encode(['detail' => $detail, 'amount' => $amount]);
    }

    /**
     * Finds the Sales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
