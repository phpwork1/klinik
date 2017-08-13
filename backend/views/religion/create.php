<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Religion */

$this->title = Yii::t('app', 'Tambah Agama');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agama'), 'url' => ['index']];
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
