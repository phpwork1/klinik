<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Registration */

$this->title = 'Tambah Registrasi';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Registrasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <!-- /.box-header -->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
