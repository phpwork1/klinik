<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccountGroup */

$this->title = Yii::t('app', 'Tambah Grup Akun');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grup Akun'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-group-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
