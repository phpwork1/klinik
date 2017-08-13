<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Diagnosis */

$this->title = Yii::t('app', 'Ubah Diagnosis');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diagnosis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->d_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
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
