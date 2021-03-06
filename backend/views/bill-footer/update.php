<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BillFooter */

$this->title = Yii::t('app', 'Ubah {modelClass}: ', [
    'modelClass' => 'Bill Footer',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill Footers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="bill-footer-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
