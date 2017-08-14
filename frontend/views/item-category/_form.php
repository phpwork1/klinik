<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;

/* @var $this yii\web\View */
/* @var $model frontend\models\ItemCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive item-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "ic_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
        ->textInput(['maxlength' => true, 'class' => 'form-control'])
        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'],[ 'class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
