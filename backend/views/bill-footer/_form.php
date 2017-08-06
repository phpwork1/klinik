<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BillFooter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-footer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'footer')->textarea(['rows' => 6, 'autofocus' => 'autofocus']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
