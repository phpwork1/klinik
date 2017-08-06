<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = 'Summary';
$this->title = Yii::t('app', 'Bulanan');
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['/site/report']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['report'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

echo $this->render('_search-monthly', ['model' => $model]);
?>

<table class="table table-hover table-striped table-vcenter">
    <thead>
        <tr>
            <th class="text-right">#</th>
            <th>Tanggal</th>
            <th class="text-right">Pembelian</th>
            <th class="text-right">Penjualan</th>
            <th class="text-right">Lain-lain</th>
            <th class="text-right">Pengeluaran</th>
            <th class="text-right">Pendptn lain</th>
            <th class="text-right">Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1 ?>
        <?php foreach ($data as $date => $record): ?>
        <?php
            if ($record['purchase'] == 0 && $record['sale'] == 0 && $record['cashSale'] == 0 && $record['expense'] == 0 && $record['income'] == 0) { continue; }
        ?>
        <tr>
            <td class="text-right"><?= $count++ ?></td>
            <td><?= $date ?></td>
            <td class="text-right"><?= Html::a(Yii::$app->formatter->asInteger($record['purchase']), ['/purchase-order/report', 'PurchaseOrderSearch[date]' => $date, 'PurchaseOrderSearch[fdate]' => '', 'PurchaseOrderSearch[tdate]' => ''], ['target' => '_blank']) ?></td>
            <td class="text-right"><?= Html::a(Yii::$app->formatter->asInteger($record['sale']), ['/sale-order/report', 'SaleOrderSearch[date]' => $date, 'SaleOrderSearch[fdate]' => '', 'SaleOrderSearch[tdate]' => ''], ['target' => '_blank']) ?></td>
            <td class="text-right"><?= Html::a(Yii::$app->formatter->asInteger($record['cashSale']), ['/cash-sale/report', 'CashSaleSearch[date]' => $date, 'CashSaleSearch[fdate]' => '', 'CashSaleSearch[tdate]' => ''], ['target' => '_blank']) ?></td>
            <td class="text-right"><?= Html::a(Yii::$app->formatter->asInteger($record['expense']), ['/expense/report', 'ExpenseSearch[date]' => $date, 'ExpenseSearch[fdate]' => '', 'ExpenseSearch[tdate]' => ''], ['target' => '_blank']) ?></td>
            <td class="text-right"><?= Html::a(Yii::$app->formatter->asInteger($record['income']), ['/income/report', 'IncomeSearch[date]' => $date, 'IncomeSearch[fdate]' => '', 'IncomeSearch[tdate]' => ''], ['target' => '_blank']) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asInteger($record['saldo']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-right">TOTAL</td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['purchase'], 0) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['sale'], 0) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['cashSale'], 0) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['expense'], 0) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['income'], 0) ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asDecimal($total['saldo'], 0) ?></td>
        </tr>
    </tfoot>
</table>

