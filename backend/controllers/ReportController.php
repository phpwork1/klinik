<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\User;
use backend\models\Report;
use backend\models\PurchaseOrderSearch;
use backend\models\SaleOrderSearch;
use backend\models\CashSaleSearch;
use backend\models\ExpenseSearch;
use backend\models\IncomeSearch;
use yii\helpers\ArrayHelper;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class ReportController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => ['class' => '\common\components\AccessRule'],
                'rules' => [
                    [
                        'actions' => ['summary', 'daily', 'monthly', 'annualy'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR, User::ROLE_CHAIRMAN, User::ROLE_DEPUTY_CHAIRMAN],
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
     * Lists Summary models.
     * @return mixed
     */
    public function actionSummary() {
        $model = new Report();
        
        $params = Yii::$app->request->queryParams;
        $model->fdate = empty($params['Report']['fdate']) ? date('Y-m-d') : $params['Report']['fdate'];
        $model->tdate = empty($params['Report']['tdate']) ? date('Y-m-d') : $params['Report']['tdate'];
        
        ## PURCHASE
        $poModel = new PurchaseOrderSearch();
        $poModel->fdate = $model->fdate;
        $poModel->tdate = $model->tdate;
        $podp = $poModel->total(null, ['field' => 'purchase_order.total']);
        //d($podp);exit;
        
        ## SALE
        $soModel = new SaleOrderSearch();
        $soModel->fdate = $model->fdate;
        $soModel->tdate = $model->tdate;
        $sodp = $soModel->total(null, ['field' => 'sale_order.total']);
        
        ## CASH SALE
        $csModel = new CashSaleSearch();
        $csModel->fdate = $model->fdate;
        $csModel->tdate = $model->tdate;
        $csdp = $csModel->total(null, ['field' => 'cash_sale.total']);
        
        ## EXPENSE
        $expModel = new ExpenseSearch();
        $expModel->fdate = $model->fdate;
        $expModel->tdate = $model->tdate;
        $expdp = $expModel->total(null, ['field' => 'amount']);
        
        ## INCOME
        $incModel = new IncomeSearch();
        $incModel->fdate = $model->fdate;
        $incModel->tdate = $model->tdate;
        $incdp = $incModel->total(null, ['field' => 'amount']);
        
        return $this->render('summary', [
            'model' => $model,
            'purchase' => $podp,
            'sale' => $sodp,
            'cashSale' => $csdp,
            'expense' => $expdp,
            'income' => $incdp,
        ]);
    }
    
    /**
     * Daily report
     * @return mixed
     */
    public function actionDaily() {
        $model = new Report();
        
        $params = Yii::$app->request->queryParams;
        $model->date = empty($params['Report']['date']) ? date('Y-m-d') : $params['Report']['date'];
        
        ## PURCHASE
        $poModel = new PurchaseOrderSearch();
        $poModel->date = $model->date;
        $podp = $poModel->total(null, ['field' => 'purchase_order.total']);
        //d($podp);exit;
        
        ## SALE
        $soModel = new SaleOrderSearch();
        $soModel->date = $model->date;
        $sodp = $soModel->total(null, ['field' => 'sale_order.total']);
        
        ## CASH SALE
        $csModel = new CashSaleSearch();
        $csModel->date = $model->date;
        $csdp = $csModel->total(null, ['field' => 'cash_sale.total']);
        
        ## EXPENSE
        $expModel = new ExpenseSearch();
        $expModel->date = $model->date;
        $expdp = $expModel->total(null, ['field' => 'amount']);
        
        ## INCOME
        $incModel = new IncomeSearch();
        $incModel->date = $model->date;
        $incdp = $incModel->total(null, ['field' => 'amount']);
        
        return $this->render('daily', [
            'model' => $model,
            'purchase' => $podp,
            'sale' => $sodp,
            'cashSale' => $csdp,
            'expense' => $expdp,
            'income' => $incdp,
        ]);
    }

    /**
     * Monthly report
     * @return mixed
     */
    public function actionMonthly() {
        $model = new Report();
        
        $params = Yii::$app->request->queryParams;
        $model->month = empty($params['Report']['month']) ? date('m') : $params['Report']['month'];
        $model->year = empty($params['Report']['year']) ? date('Y') : $params['Report']['year'];
        $period = $model->year . '-' . $model->month;
        $dates = \common\components\helpers\AppFunction::dateIntervalInMonth($period);
        
        $purchaseOrders = ArrayHelper::map(PurchaseOrderSearch::find()->select(['id', 'date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('date')->all(), 'date', 'total');
        $saleOrders = ArrayHelper::map(SaleOrderSearch::find()->select(['id', 'date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('date')->all(), 'date', 'total');
        $cashSales = ArrayHelper::map(CashSaleSearch::find()->select(['id', 'date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('date')->all(), 'date', 'total');
        $expenses = ArrayHelper::map(ExpenseSearch::find()->select(['id', 'date', 'SUM(amount) as amount'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('date')->all(), 'date', 'amount');
        $incomes = ArrayHelper::map(IncomeSearch::find()->select(['id', 'date', 'SUM(amount) as amount'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('date')->all(), 'date', 'amount');

        ## GABUNG
        $data = [];
        $total = ['purchase' => 0, 'sale' => 0, 'cashSale' => 0, 'expense' => 0, 'income' => 0, 'saldo' => 0];
        foreach ($dates as $date) {
            $data[$date]['purchase'] = empty($purchaseOrders[$date]) ? 0 : $purchaseOrders[$date];
            $data[$date]['sale'] = empty($saleOrders[$date]) ? 0 : $saleOrders[$date];
            $data[$date]['cashSale'] = empty($cashSales[$date]) ? 0 : $cashSales[$date];
            $data[$date]['expense'] = empty($expenses[$date]) ? 0 : $expenses[$date];
            $data[$date]['income'] = empty($incomes[$date]) ? 0 : $incomes[$date];
            $data[$date]['saldo'] = ($data[$date]['sale'] + $data[$date]['cashSale'] + $data[$date]['income']) - ($data[$date]['purchase'] + $data[$date]['expense']);
            
            $total['purchase'] += $data[$date]['purchase'];
            $total['sale'] += $data[$date]['sale'];
            $total['cashSale'] += $data[$date]['cashSale'];
            $total['expense'] += $data[$date]['expense'];
            $total['income'] += $data[$date]['income'];
            $total['saldo'] += $data[$date]['saldo'];
        }
        return $this->render('monthly', [
            'model' => $model,
            'period' => $period,
            'data' => $data,
            'total' => $total,
        ]);
    }

    /**
     * Annual report
     * @return mixed
     */
    public function actionAnnualy() {
        $model = new Report();
        
        $params = Yii::$app->request->queryParams;
        $model->year = empty($params['Report']['year']) ? date('Y') : $params['Report']['year'];
        $period = $model->year;
        $months = \common\components\helpers\AppConst::$mnth;
        
        $purchaseOrders = ArrayHelper::map(PurchaseOrderSearch::find()->select(['id', 'EXTRACT(MONTH FROM date) AS date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('MONTH(date)')->all(), 'date', 'total');
        $saleOrders = ArrayHelper::map(SaleOrderSearch::find()->select(['id', 'EXTRACT(MONTH FROM date) AS date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('MONTH(date)')->all(), 'date', 'total');
        $cashSales = ArrayHelper::map(CashSaleSearch::find()->select(['id', 'EXTRACT(MONTH FROM date) AS date', 'SUM(total) as total'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('MONTH(date)')->all(), 'date', 'total');
        $expenses = ArrayHelper::map(ExpenseSearch::find()->select(['id', 'EXTRACT(MONTH FROM date) AS date', 'SUM(amount) as amount'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('MONTH(date)')->all(), 'date', 'amount');
        $incomes = ArrayHelper::map(IncomeSearch::find()->select(['id', 'EXTRACT(MONTH FROM date) AS date', 'SUM(amount) as amount'])->where('date LIKE :date', ['date' => $period . '%'])->orderBy('date')->groupBy('MONTH(date)')->all(), 'date', 'amount');

        ## GABUNG
        $data = [];
        $total = ['purchase' => 0, 'sale' => 0, 'cashSale' => 0, 'expense' => 0, 'income' => 0, 'saldo' => 0];
        foreach ($months as $key => $value) {
            ## convert $key to 2 digit format
            $key2 = str_pad($key, 2, '0', STR_PAD_LEFT);
            $data[$key2]['purchase'] = empty($purchaseOrders[$key]) ? 0 : $purchaseOrders[$key];
            $data[$key2]['sale'] = empty($saleOrders[$key]) ? 0 : $saleOrders[$key];
            $data[$key2]['cashSale'] = empty($cashSales[$key]) ? 0 : $cashSales[$key];
            $data[$key2]['expense'] = empty($expenses[$key]) ? 0 : $expenses[$key];
            $data[$key2]['income'] = empty($incomes[$key]) ? 0 : $incomes[$key];
            $data[$key2]['saldo'] = ($data[$key2]['sale'] + $data[$key2]['cashSale'] + $data[$key2]['income']) - ($data[$key2]['purchase'] + $data[$key2]['expense']);
            
            $total['purchase'] += $data[$key2]['purchase'];
            $total['sale'] += $data[$key2]['sale'];
            $total['cashSale'] += $data[$key2]['cashSale'];
            $total['expense'] += $data[$key2]['expense'];
            $total['income'] += $data[$key2]['income'];
            $total['saldo'] += $data[$key2]['saldo'];
        }
        
        return $this->render('annualy', [
            'model' => $model,
            'period' => $period,
            'data' => $data,
            'total' => $total,
        ]);
    }

}
