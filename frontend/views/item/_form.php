<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
use frontend\models\ItemCategory;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, "item_category_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->dropDownList(ItemCategory::map(), ['class' => 'input-big form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_description", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textArea(['maxlength' => true, 'class' => 'form-control', 'rows' => 2])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_factory", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>



                <?= $form->field($model, "i_stock_amount", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_unit", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, 'i_expired_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
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
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, "i_buy_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_sell_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_ppn", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_retail_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_net_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_blend_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_stock_min", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                <?= $form->field($model, "i_stock_max", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

            </div>

        </div>


        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Back'), ['index'],[ 'class' => 'btn btn-danger']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
