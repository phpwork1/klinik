<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21/8/2017
 * Time: 3:47 PM
 */

use yii\helpers\Html;
use common\components\helpers\AppConst;
use backend\assets\MedicineBlendedTherapyAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\RMedicine */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
MedicineBlendedTherapyAsset::register($this);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, "item_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->dropDownList(\frontend\models\Item::map(null, null, ['i_blended' => 1]), ['class' => 'input-big form-control', 'prompt' => '--Silahkan Pilih--'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, "rmr_amount", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textInput(['maxlength' => true, 'class' => 'form-control'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, "rmr_dosage_1", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textInput(['maxlength' => true, 'class' => 'form-control'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, "rmr_dosage_2", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textInput(['maxlength' => true, 'class' => 'form-control'])
                ->label('X', ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, "rmr_dosage_3", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textInput(['maxlength' => true, 'class' => 'form-control'])
                ->label("", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, "rmr_ref", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => 2])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="pull-right">
                <?= $form->field($model, "registration_id")
                    ->hiddenInput(['value' => $registration_id])->label(false) ?>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>

