<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;

/* @var $this yii\web\View */
/* @var $model backend\models\RDiagnosis */
/* @var $form yii\widgets\ActiveForm */
/* @var $registrationId int */
?>

<div class="box-body table-responsive diagnosis-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, "registration_id")
                    ->hiddenInput(['value' => $registrationId])->label(false) ?>
                <?= $form->field($model, "rd_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
            <div class="pull-right">
                <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Tambah', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
