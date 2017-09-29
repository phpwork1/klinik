<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/25/2017
 * Time: 10:47 AM
 */

namespace frontend\controllers;

use frontend\models\Customer;
use frontend\models\GoodsPurchaseReturn;
use frontend\models\Sales;
use frontend\models\SalesReturn;
use frontend\models\Supplier;
use frontend\models\GoodsPurchase;
use frontend\models\ItemCategory;
use yii\web\Controller;
use frontend\models\Item;
use Yii;
use common\components\helpers\AppConst;


class ReportController extends Controller
{
    public function actionItemReport()
    {
        $itemCategory = ItemCategory::map('id', 'ic_name');
        $itemList = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if ($requestData['itemCategoryList'] != '') {
                $itemList = Item::find()->where(['item_category_id' => $requestData['itemCategoryList']])->all();
            } else {
                $itemList = Item::find()->all();
            }
        }

        return $this->render('item-report', [
            'itemCategory' => $itemCategory,
            'itemList' => $itemList,
        ]);
    }

    public function actionSupplierReport()
    {
        $supplierList = Supplier::find()->all();

        return $this->render('supplier-report', [
            'supplierList' => $supplierList,
        ]);
    }

    public function actionCustomerReport()
    {
        $customerList = Customer::find()->all();

        return $this->render('customer-report', [
            'customerList' => $customerList,
        ]);
    }

    public function actionGoodsPurchaseReport()
    {
        $supplierList = Supplier::map('id', 's_name');
        $goodsPurchaseList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();

            if ($requestData['supplierList'] != '') {
                $goodsPurchaseList = GoodsPurchase::find()->where(['supplier_id' => $requestData['supplierList']]);

            } else {
                $goodsPurchaseList = GoodsPurchase::find();
            }


            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                $goodsPurchaseList->andFilterWhere(['between', 'gp_date', $fromDate, $toDate]);
            }
            $goodsPurchaseList = $goodsPurchaseList->all();
        }

        return $this->render('goods-purchase-report', [
            'supplierList' => $supplierList,
            'goodsPurchaseList' => $goodsPurchaseList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function actionSalesExternalReport()
    {
        $customerList = Customer::map('c_name', 'c_name');
        $salesList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();

            if ($requestData['customerList'] != '') {
                $salesList = Sales::find()->where(['s_buyer' => $requestData['customerList']]);

            } else {
                $salesList = Sales::find();
            }

            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                $salesList->andFilterWhere(['between', 's_date', $fromDate, $toDate]);
            }
            $salesList = $salesList->all();
        }

        return $this->render('sales-external-report', [
            'customerList' => $customerList,
            'salesList' => $salesList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function actionSalesInternalReport()
    {
        $salesList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();

            $salesList = Sales::find()->joinWith(['salesTypes st'], true, 'INNER JOIN');

            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                $salesList->andFilterWhere(['between', 's_date', $fromDate, $toDate]);
            }
            $salesList = $salesList->all();
        }

        return $this->render('sales-internal-report', [
            'salesList' => $salesList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function actionGoodsPurchaseReturnReport()
    {
        $supplierList = Supplier::map('id', 's_name');
        $goodsPurchaseReturnList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();

            if ($requestData['supplierList'] != '') {
                $goodsPurchaseReturnList = GoodsPurchaseReturn::find()->joinWith(['goodsPurchase gp'], true, 'INNER JOIN')->where(['gp.supplier_id' => $requestData['supplierList']]);

            } else {
                $goodsPurchaseReturnList = GoodsPurchaseReturn::find();
            }

            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                $goodsPurchaseReturnList->andFilterWhere(['between', 'gpr_date', $fromDate, $toDate]);
            }

            $goodsPurchaseReturnList = $goodsPurchaseReturnList->all();
        }

        return $this->render('goods-purchase-return-report', [
            'supplierList' => $supplierList,
            'goodsPurchaseReturnList' => $goodsPurchaseReturnList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function actionSalesReturnReport()
    {
        $customerList = Customer::map('c_name', 'c_name');
        $salesReturnList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();

            if ($requestData['customerList'] != '') {
                $salesReturnList = SalesReturn::find()->joinWith(['sales s'], true, 'INNER JOIN')->where(['s.s_buyer' => $requestData['customerList']]);

            } else {
                $salesReturnList = SalesReturn::find();
            }

            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                $salesReturnList->andFilterWhere(['between', 'sr_date', $fromDate, $toDate]);
            }
            $salesReturnList = $salesReturnList->all();
        }

        return $this->render('sales-return-report', [
            'customerList' => $customerList,
            'salesReturnList' => $salesReturnList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function actionItemStockReport()
    {
        $itemCategory = ItemCategory::map('id', 'ic_name');
        $itemList = null;
        $toDate = null;
        $fromDate = null;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            if ($requestData['itemCategoryList'] != '') {
                $itemList = Item::find()->where(['item_category_id' => $requestData['itemCategoryList']]);
            } else {
                $itemList = Item::find();
            }

            if (($requestData['fromDate'] != '') && ($requestData['toDate'] != '')) {
                $fromDate = Yii::$app->formatter->asDate($requestData['fromDate'], AppConst::FORMAT_DB_DATE_PHP);
                $toDate = Yii::$app->formatter->asDate($requestData['toDate'], AppConst::FORMAT_DB_DATE_PHP);
                //$itemList->andFilterWhere(['between', 'sr_date', $fromDate, $toDate]);

                $itemList = $itemList->all();
            }
        }

        return $this->render('item-stock-report', [
            'itemCategory' => $itemCategory,
            'itemList' => $itemList,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }
}