<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountCategory */

$this->title = Yii::t('app', 'Ubah {modelClass}: ', [
    'modelClass' => 'Kategori Akun',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kategori Akun'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="account-category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
