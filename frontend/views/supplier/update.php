<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Supplier */

$this->title = 'Ubah Suplier: ' . $model->s_name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Suplier', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->s_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]);
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <!-- /.box-header -->
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
</div>
