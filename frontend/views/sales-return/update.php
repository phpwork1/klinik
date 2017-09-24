<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesReturn */
/* @var $invoiceList frontend\models\Sales[] */
/* @var $itemList frontend\models\SalesDetail[] */

$this->title = 'Ubah Retur Penjualan No. Retur: ' . $model->sr_return_number;
$this->params['breadcrumbs'][] = ['label' => 'Retur Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]);
?>
<!-- /.box-header -->
<?= $this->render('_form', [
    'model' => $model,
    'invoiceList' => $invoiceList,
    'itemList' => $itemList,
]) ?>
