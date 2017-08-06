<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Regency */

$this->title = Yii::t('app', 'Create Regency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regencies'), 'url' => ['index']];
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
