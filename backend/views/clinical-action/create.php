<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ClinicalAction */

$this->title = Yii::t('app', 'Tambah Layanan Klinik Kecantikan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tindakan Klinik Kecantikan'), 'url' => ['index']];
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
