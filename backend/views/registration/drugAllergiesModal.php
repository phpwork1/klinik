<?php

use yii\helpers\Html;
use common\components\helpers\AppConst;

/* @var $this yii\web\View */
/* @var $model backend\models\DrugAllergies */
/* @var $registrationModel backend\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive drug-allergies-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, "registration_id")
                    ->hiddenInput(['value' => $registrationModel->id])->label(false) ?>
                <?= $form->field($model, "patient_id")
                    ->hiddenInput(['value' => $registrationModel->patient_id])->label(false) ?>
                <?= $form->field($model, "da_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
            <div class="pull-right">
                <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Tambah', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
