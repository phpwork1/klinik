<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = 'Summary';
$this->title = Yii::t('app', 'Rangkuman');
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['/site/report']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['report'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

echo $this->render('_search', ['model' => $model]);

$total = ($sale + $cashSale + $income) - ($purchase + $expense);
?>

<table class="table table-hover table-striped table-vcenter">
    <tbody>
        <tr>
            <th class="col-sm-3">Pembelian</th>
            <td class="col-sm-9"><?= Html::a(Yii::$app->formatter->asDecimal($purchase), ['/purchase-order/report', 'PurchaseOrderSearch[fdate]' => $model->fdate, 'PurchaseOrderSearch[tdate]' => $model->tdate]) ?></td>
        </tr>
        <tr>
            <th class="col-sm-3">Penjualan</th>
            <td class="col-sm-9"><?= Html::a(Yii::$app->formatter->asDecimal($sale, 0), ['/sale-order/report', 'SaleOrderSearch[fdate]' => $model->fdate, 'SaleOrderSearch[tdate]' => $model->tdate]) ?></td>
        </tr>
        <tr>
            <th class="col-sm-3">Lain-lain</th>
            <td class="col-sm-9"><?= Html::a(Yii::$app->formatter->asDecimal($cashSale, 0), ['/cash-sale/report', 'CashSaleSearch[fdate]' => $model->fdate, 'CashSaleSearch[tdate]' => $model->tdate]) ?></td>
        </tr>
        <tr>
            <th class="col-sm-3">Pengeluaran</th>
            <td class="col-sm-9"><?= Html::a(Yii::$app->formatter->asDecimal($expense, 0), ['/expense/report', 'ExpenseSearch[fdate]' => $model->fdate, 'ExpenseSearch[tdate]' => $model->tdate]) ?></td>
        </tr>
        <tr>
            <th class="col-sm-3">Pendapatan lain-lain</th>
            <td class="col-sm-9"><?= Html::a(Yii::$app->formatter->asDecimal($income, 0), ['/income/report', 'IncomeSearch[fdate]' => $model->fdate, 'IncomeSearch[tdate]' => $model->tdate]) ?></td>
        </tr>
        <tr>
            <th class="col-sm-3">Total</th>
            <td class="col-sm-9"><?= Yii::$app->formatter->asDecimal($total, 0) ?></td>
        </tr>
    </tbody>
</table>
