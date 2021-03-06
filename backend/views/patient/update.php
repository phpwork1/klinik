<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = Yii::t('app', sprintf("%s %s","Ubah Data Pasien", $model->p_name));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pasien'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
