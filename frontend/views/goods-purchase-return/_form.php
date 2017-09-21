<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;
use frontend\assets\GoodsPurchaseReturnAsset;
use yii\helpers\Url;
use frontend\assets\ChosenAsset;

$currentUrl = Url::current();
$baseUrl = Url::base();

GoodsPurchaseReturnAsset::register($this);
ChosenAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchaseReturn */
/* @var $form yii\widgets\ActiveForm */
/* @var $invoiceList frontend\models\GoodsPurchase[] */
/* @var $itemList frontend\models\GpDetail[] */
?>

<?php $form = ActiveForm::begin([
    'id' => 'goods-purchase-return-form',
    'options' => [
        'class' => 'calx',
    ],
]); ?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>

<div class="box box-primary">
    <div class="box-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "gpr_return_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', ])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'gpr_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->widget(
                            DatePicker::className(), [
                                'options' => [
                                    'class' => 'form-control'
                                ],
                            ]
                        )
                        ->label("Tanggal", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "goods_purchase_id", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->dropDownList($invoiceList, ['class' => 'invoice-list input-big form-control chosen-select', 'disabled' => !$model->getIsNewRecord() ? true : false, 'prompt' => '--Silahkan Pilih--'])
                        ->label("No. Faktur", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= $form->field($model, "gpr_supplier_name")
                        ->hiddenInput(['id' => 'supplierName'])
                        ->label(false);
                    ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, "gpr_total_return", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control text-right', 'readOnly' => true, 'data-cell' => 'X1', 'data-formula' => "SUM(A0:A999)"])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-primary']) ?>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="box box-primary">
    <div class="box-body goods-purchase-form">
        <div class="container-fluid">
            <div class="row">
                <?php \yii\widgets\Pjax::begin(['id' => 'pjaxItemList']); ?>
                <div class="col-xs-12 col-md-4">
                    <?= Html::label("Nama Barang", "itemList", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::dropDownList("itemList", null, $itemList, ['id' => 'goodsPurchaseReturnAddItem', 'class' => 'input-big form-control chosen-select', 'prompt' => '--Silahkan Pilih--']) ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= Html::label("Harga", "itemPrice", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemPrice", null, ['id' => 'goodsPurchaseReturnPrice', 'class' => 'text-right input-group form-control', 'readOnly' => true]); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= Html::label("Jumlah", "itemAmount   ", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemAmount", null, ['id' => 'goodsPurchaseReturnAmount','class' => 'text-right input-group form-control']); ?>
                </div>
                <?php \yii\widgets\Pjax::end(); ?>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label(''); ?>
                    <?= Html::button('<span class="glyphicon glyphicon-plus"></span>Tambah', ['id' => 'goodsPurchaseReturnAddItemButton', 'class' => 'btn btn-block btn-success']); ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body table-responsive">
        <div class="container-fluid">
            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="3%" class="text-center">
                            No
                        </th>
                        <th width="40%" class="text-center">
                            Nama Barang
                        </th>
                        <th class="text-center">
                            Harga
                        </th>
                        <th width="7%" class="text-center">
                            Jumlah
                        </th>
                        <th width="15%" class="text-center">
                            Total
                        </th>
                        <th width="10%" class="text-center">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->goodsPurchaseReturnDetails as $keyD => $detail): ?>
                        <tr>
                            <td class="text-center">
                                <?= ($keyD + 1) ?>
                                <?= Html::hiddenInput("dropdownRemoveId", $detail->gp_detail_id, ['class' => 'dropdownRemoveId'])?>
                            </td>
                            <td class="text-center"><?= $detail->gprd_name ?></td>
                            <td class="text-center"><?= sprintf("Rp. %s", number_format($detail->gprd_price,0, '.', ',')); ?></td>
                            <td class="text-center"><?= $detail->gprd_quantity ?></td>
                            <td class="text-center">
                                <?= sprintf("Rp. %s",number_format($detail->gprd_price*$detail->gprd_quantity,0, '.', ',')); ?>
                                <?= Html::hiddenInput("totalPrice",  $detail->gprd_price*$detail->gprd_quantity, ['data-cell' => "A$keyD"]); ?>
                            </td>
                            <td class="text-center"><?= Html::button("Hapus", ['class' => 'btn btn-danger btn-remove-ajax', 'data-id' => $detail->id, 'data-detail' => $detail->gp_detail_id, 'data-controller' => 'goods-purchase-return']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
