<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountGroup */

$this->title = Yii::t('app', 'Ubah {modelClass}: ', [
    'modelClass' => 'Grup Akun',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grup Akun'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="account-group-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
