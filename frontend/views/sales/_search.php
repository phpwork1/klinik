<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-search">
    <?php $form = ActiveForm::begin(['action' => ['report'], 'method' => 'get']); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'fdate')->widget(DatePicker::classname(), [                'options' => ['placeholder' => 'Dari Tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ])->label(FALSE) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'tdate')->widget(DatePicker::classname(), [                'options' => ['placeholder' => 'Sampai Tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ])->label(FALSE) ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"></label>
                <button type="submit" class="btn btn-primary">Search</button>                <button type="reset" class="btn btn-warning">Reset</button>            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
