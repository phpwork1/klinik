<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Supplier */

$this->title = 'Tambah Suplier';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Suplier', 'url' => ['index']];
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
