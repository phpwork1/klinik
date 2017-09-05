<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchase */
/* @var $gpDetailModel frontend\models\GpDetail */
/* @var $addItemModel frontend\models\Item */
/* @var $addSupplierModel frontend\models\Supplier */

$this->title = 'Update Goods Purchase: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Goods Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
    'gpDetailModel' => $gpDetailModel,
    'addItemModel' => $addItemModel,
    'addSupplierModel' => $addSupplierModel,
]) ?>
