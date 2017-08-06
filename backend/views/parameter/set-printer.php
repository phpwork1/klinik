<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Parameter */
/* @var $printer backend\models\Printer */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Ubah Setting') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="parameter-update">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">            
            <?= $form->field($model, 'invoice_printer')->dropDownList(\backend\models\Printer::map(), ['autofocus' => 'autofocus']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">            
            <?= $form->field($model, 'receipt_printer')->dropDownList(\backend\models\Printer::map()) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
