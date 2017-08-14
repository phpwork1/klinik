<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Diagnosis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive diagnosis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'd_name')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'],[ 'class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>