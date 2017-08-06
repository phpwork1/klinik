<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseReturnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-return-search">

    <?php $form = ActiveForm::begin(['action' => ['daily'], 'method' => 'get']); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'year')->dropDownList(\common\components\helpers\AppFunction::year())->label(false) ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"></label>
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
