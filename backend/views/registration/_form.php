<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive registration-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "r_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control', 'disabled' => $model->getIsNewRecord() ? false : true, 'value' => $model->getIsNewRecord() ? sprintf('%06d', $model->getRegistrationNumber()) : $model->r_number])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
            <div class="col-xs-12 col-md-5">
                <?= $form->field($model, 'r_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->widget(
                        DatePicker::className(), [
                            'options' => [
                                'class' => 'form-control'
                            ],
                        ]
                    )
                    ->label(false);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "patient_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->dropDownList(\backend\models\Patient::map(), ['class' => 'input-big form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "r_patient_weight", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
            <div class="col-xs-12 col-md-5">
                <?= $form->field($model, "r_patient_tension", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "r_patient_temp", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "r_complaint", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => 4])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?= $form->field($model, "r_position", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->dropDownList($model->actionList, ['class' => 'input-big form-control', 'prompt' => '--Silahkan Pilih--'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="box-footer">
            <?= $form->field($model, "r_checked")
                ->hiddenInput(['value' => 0])->label(false) ?>
            <?= $form->field($model, "r_paid")
                ->hiddenInput(['value' => 0])->label(false) ?>
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-danger']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
