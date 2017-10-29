<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">
    <?= "<?php " ?>$form = ActiveForm::begin(['action' => ['report'], 'method' => 'get']); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= "<?= \$form->field(\$model, 'fdate')->widget(DatePicker::classname(), [" ?>
                'options' => ['placeholder' => 'Dari Tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ])->label(FALSE) ?>
        </div>
        <div class="col-sm-3">
            <?= "<?= \$form->field(\$model, 'tdate')->widget(DatePicker::classname(), [" ?>
                'options' => ['placeholder' => 'Sampai Tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ])->label(FALSE) ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"></label>
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']) ?>
            </div>
        </div>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
