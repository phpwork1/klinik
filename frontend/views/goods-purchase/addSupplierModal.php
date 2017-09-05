<?php

use yii\helpers\Html;
use common\components\helpers\AppConst;

/* @var $this yii\web\View */
/* @var $model frontend\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive supplier-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, "s_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "s_address", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => '4'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "s_phone_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "s_contact_person", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "s_file", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->fileInput()->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
