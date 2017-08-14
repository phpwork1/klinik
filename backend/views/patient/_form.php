<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\components\helpers\AppConst;


/* @var $this yii\web\View */
/* @var $model backend\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "p_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
    <?= $form->field($model, "p_pob", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, 'p_dob', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->widget(
            DatePicker::className(), [
                'clientOptions' => [
                    'defaultDate' => time(),
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]
        )
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
    ?>

    <?= $form->field($model, "p_gender", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->dropDownList($model->genderList, ['class' => 'input-big form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "religion_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->dropDownList(\backend\models\Religion::map(), ['class' => 'input-big form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "p_address", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "p_postal_code", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "p_contact_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "job_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->dropDownList(\backend\models\Job::map(), ['class' => 'input-big form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <?= $form->field($model, "patient_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->dropDownList(\backend\models\Patient::map(), ['class' => 'input-big form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'],[ 'class' => 'btn btn-danger']); ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
