<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Religion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive religion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'religion_name')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
