<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClinicalAction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive clinical-action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ca_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ca_cost')->textInput() ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'],[ 'class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
