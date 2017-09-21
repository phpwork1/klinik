<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchaseReturn */
/* @var $invoiceList frontend\models\GoodsPurchase[] */
/* @var $itemList frontend\models\GpDetail[] */

$this->title = 'Ubah Retur Pembelian No Retur: ' . $model->gpr_return_number;
$this->params['breadcrumbs'][] = ['label' => 'Retur Pembelian', 'url' => ['index']];
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
