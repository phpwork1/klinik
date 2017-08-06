<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccountCategory */

$this->title = Yii::t('app', 'Tambah Kategori Akun');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kategori Akun'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
