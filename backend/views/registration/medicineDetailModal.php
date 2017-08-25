<?php

use yii\helpers\Html;
use common\components\helpers\AppConst;
use backend\assets\MedicineDetailModalAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\RmDetail */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
MedicineDetailModalAsset::register($this);
$baseUrl = Url::base();
?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>
<div class="box-body table-responsive diagnosis-form">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, "item_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->dropDownList(\frontend\models\Item::map(null, null, ['i_blended' => 0]), ['id' => 'itemModal', 'class' => 'input-big form-control', 'prompt' => '--Silahkan Pilih--'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                <?= Html::textInput('stock_item', "", ['id' => 'stockModal', 'class' => 'form-control text-right', 'disabled' => true, 'placeholder' => "Jumlah Stok"]); ?>
                <?= Html::textInput('price_item', "", ['id' => 'priceModal', 'class' => 'form-control text-right', 'disabled' => true, 'placeholder' => 'Harga Barang']); ?>
                <br/>
                <?= $form->field($model, "registration_id")
                    ->hiddenInput(['value' => $registration_id])
                    ->label(false); ?>
                <?= $form->field($model, "rmd_amount", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
            <div class="pull-right">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

</div>
