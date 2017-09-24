<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;
use frontend\assets\SalesAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use frontend\assets\ChosenAsset;

$currentUrl = Url::current();
$baseUrl = Url::base();

SalesAsset::register($this);
ChosenAsset::register($this);
/* @var $this yii\web\View */
/* @var $model frontend\models\Sales */
/* @var $registrationModel backend\models\Registration */
/* @var $salesType frontend\models\SalesType */
/* @var $allItem frontend\models\Item[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $type string */
/* @var $itemList [] */
Modal::begin([
    'id' => 'salesDetailItemModal',
    'header' => '<h2>Detail Barang' . '</h2>',
    'size' => MODAL::SIZE_LARGE,
]);
echo $this->render('detailItemModal', ['model' => $allItem]);
Modal::end();
?>

<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>

<?php $form = ActiveForm::begin([
    'id' => 'sales-form',
    'options' => [
        'class' => 'calx',
    ],
]); ?>
<?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_INTERNAL) : ?>
    <?php echo Html::activeHiddenInput($salesType, 'registration_id'); ?>
<?php endif; ?>
<?php if (!$model->getIsNewRecord() && $type == \frontend\controllers\SalesController::SALES_TYPE_INTERNAL) {
    echo Html::activeHiddenInput($salesType, 'id');
    echo Html::activeHiddenInput($salesType, 'sales_id');
} ?>
<div class="box box-primary">
    <div class="box-body sales-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <?= Html::label("Nama Barang", "itemList", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) {
                        echo Html::button('<span class="glyphicon glyphicon-search"></span>', ['class' => 'salesDetailItemModalButton']);
                    } ?>
                    <?= Html::dropDownList("itemList", null, $itemList, ['id' => $type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL ? 'salesAddItemExternal' : 'salesAddItemInternal', 'class' => 'salesAddItem chosen-select form-control', 'prompt' => '--Silahkan Pilih--']) ?>
                </div>
                <div class="col-xs-12 <?= $type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL ? 'col-md-2' : 'col-md-3' ?>">
                    <?= Html::label("Harga", "itemPrice", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemPrice", null, ['id' => 'salesPrice', 'class' => 'text-right input-group form-control']); ?>
                </div>
                <div class="col-xs-12 <?= $type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL ? 'col-md-2' : 'col-md-3' ?>">
                    <?= Html::label("Jumlah", "itemAmount", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemAmount", null, ['id' => 'salesAmount', 'class' => 'text-right input-group form-control']); ?>
                </div>
                <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                    <div class="col-xs-12 col-md-2">
                        <?= Html::label("Disk(%)", "itemDiscount", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                        <?= Html::textInput("itemDiscount", null, ['id' => 'salesDiscount', 'class' => 'text-right input-group form-control']); ?>
                    </div>
                <?php } ?>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label(''); ?>
                    <?= Html::button('<span class="glyphicon glyphicon-plus"></span>Tambah', ['data-type' => $type, 'id' => 'salesAddItemButton', 'class' => 'btn btn-block btn-success']); ?>
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
                        <th width="30%" class="text-center">
                            Nama Barang
                        </th>
                        <th width="15%" class="text-center">
                            Harga
                        </th>
                        <th width="15%" class="text-center">
                            Jumlah
                        </th>
                        <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                            <th width="7%" class="text-center">
                                Disk(%)
                            </th>
                        <?php } ?>
                        <th width="20%" class="text-center">
                            Total
                        </th>
                        <th width="10%" class="text-center">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->salesDetails as $keyD => $detail): ?>
                        <?php $totalBlendPrice = 0; ?>
                        <tr>
                            <td class="text-center"><?= ($keyD + 1) ?></td>
                            <td>
                                <?= $detail->item->i_name ?>
                                <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) : ?>
                                    <?= Html::hiddenInput("dropdownRemoveId", $detail->item_id, ['class' => 'dropdownRemoveId itemName', 'data-type' => $type])?>
                                <?php endif; ?>
                                <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_INTERNAL) : ?>
                                    <?= Html::hiddenInput("itemName", $detail->item_id, ['class' => 'itemName', 'data-type' => $type, 'data-medicine' =>$detail->salesDetailInternals[0]->r_medicine_id])?>
                                    <?= Html::hiddenInput("dropdownRemoveId", $detail->salesDetailInternals[0]->r_medicine_id, ['class' => 'dropdownRemoveId'])?>
                                    <ul>
                                        <?php foreach ($detail->salesDetailInternals[0]->rMedicine->rmDetails as $keyR => $rmDetail) : ?>
                                            <?php $totalBlendPrice += $rmDetail->rmd_amount * $rmDetail->item->i_blend_price; ?>
                                            <li>
                                                <?= sprintf("%s >> %s x Rp. %s = Rp. %s", $rmDetail->item->i_name, $rmDetail->rmd_amount, number_format($rmDetail->item->i_blend_price,0,'.', ','), number_format($rmDetail->rmd_amount * $rmDetail->item->i_blend_price,0,'.',',')); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                            <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                                <td class="text-center"><?= sprintf("Rp. %s", number_format($detail->item->i_sell_price, 0, '.', ',')); ?></td>
                                <td class="text-center"><?= $detail->sd_quantity ?></td>
                                <td class="text-center"><?= $detail->sd_discount ?></td>
                                <td class="text-center">
                                    <?= sprintf("Rp. %s", number_format($detail->item->i_sell_price * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)),0, '.', ',')); ?>
                                    <?= Html::hiddenInput("total", $detail->item->i_sell_price * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)), ['data-cell' => "A$keyD"]); ?>
                                </td>
                            <?php } else { ?>
                                <?php if($detail->item->i_blended == 0){ $totalBlendPrice = $detail->item->i_sell_price;} ?>
                                <td class="text-center"><?= sprintf("Rp. %s", number_format($totalBlendPrice,0, '.', ',')); ?></td>
                                <td class="text-center"><?= $detail->sd_quantity ?></td>
                                <td class="text-center">
                                    <?= sprintf("Rp. %s", number_format($totalBlendPrice * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)),0, '.', ',')); ?>
                                    <?= Html::hiddenInput("total", $totalBlendPrice * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)), ['data-cell' => "A$keyD"]); ?>
                                </td>
                            <?php } ?>
                            <td class="text-center"><?= Html::button("Hapus", ['class' => 'btn btn-danger btn-remove-ajax', 'data-id' => $detail->id, 'data-controller' => 'sales']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body table-responsive">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "s_invoice_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $model->getIsNewRecord() ? $model->getInvoiceNumber() : $model->s_invoice_number])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "s_buyer", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $type == 1 ? $model->s_buyer : $registrationModel->patient->p_name])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'total', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-formula' => 'SUM(A0:A999)', 'data-cell' => 'X1', 'data-format' => '0,0'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 's_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
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
                <div class="col-md-6">
                    <?= $form->field($model, 's_total_paid', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'data-cell' => 'Y1'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, "s_cashier", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true, 'value' => \frontend\models\Person::findOne(Yii::$app->user->identity->person_id)->name])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'change', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-formula' => 'Y1-X1', 'data-cell' => 'Z1', 'data-format' => '0,0'])
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

<?php ActiveForm::end(); ?>
