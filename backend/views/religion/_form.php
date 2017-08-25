<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
/* @var $this yii\web\View */
/* @var $model backend\models\Religion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive religion-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <?= $form->field($model, "r_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->textInput(['maxlength' => true, 'class' => 'form-control'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Kembali'), ['index'], ['class' => 'btn btn-danger']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
