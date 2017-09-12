<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;
use frontend\assets\SalesAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;


$currentUrl = Url::current();
$baseUrl = Url::base();

SalesAsset::register($this);
/* @var $this yii\web\View */
/* @var $model frontend\models\Sales */
/* @var $registrationModel backend\models\Registration */
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
<div class="box box-primary">
    <div class="box-body goods-purchase-form">
        <div class="container-fluid">
            <div class="row">
                <?php \yii\widgets\Pjax::begin(['id' => 'pjaxItemList']); ?>
                <div class="col-xs-12 col-md-4">
                    <?= Html::label("Nama Barang", "itemList", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) {
                        echo Html::button('<span class="glyphicon glyphicon-search"></span>', ['class' => 'salesDetailItemModalButton']);
                    } ?>
                    <?= Html::dropDownList("itemList", null, $itemList, ['id' => $type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL ? 'salesAddItemExternal' : 'salesAddItemInternal', 'class' => 'salesAddItem input-big form-control', 'prompt' => '--Silahkan Pilih--']) ?>
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
                <?php \yii\widgets\Pjax::end(); ?>
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
                        <tr>
                            <td class="text-center"><?= ($keyD + 1) ?></td>
                            <td class="text-center"><?= $detail->item->i_name ?></td>
                            <td class="text-center"><?= sprintf("Rp. %s", $detail->item->i_sell_price); ?></td>
                            <td class="text-center"><?= $detail->sd_quantity ?></td>
                            <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                                <td class="text-center"><?= $detail->sd_discount ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <?= sprintf("Rp. %s", $detail->item->i_sell_price * $detail->sd_quantity * (1 - ($detail->sd_discount / 100))); ?>
                                <?= Html::hiddenInput("totalPrice", $detail->gpd_price * $detail->gpd_quantity, ['data-cell' => "A$keyD"]); ?>
                            </td>
                            <td class="text-center"><?= Html::button("Hapus", ['class' => 'btn btn-danger btn-remove-ajax', 'data-id' => $detail->id, 'data-controller' => 'goods-purchase']); ?></td>
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
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "s_buyer", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $type == 1 ? '' : $registrationModel->patient->p_name])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'total', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-cell' => 'X1', 'data-format' => '0,0'])
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
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'value' => 0])
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
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-cell' => 'T1', 'data-format' => '0,0'])
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
