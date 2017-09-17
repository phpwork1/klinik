<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;
use frontend\assets\GoodsPurchaseAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use frontend\assets\ChosenAsset;


$currentUrl = Url::current();
$baseUrl = Url::base();

ChosenAsset::register($this);
GoodsPurchaseAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchase */
/* @var $form yii\widgets\ActiveForm */
/* @var $gpDetailModel frontend\models\GpDetail */
/* @var $addItemModel frontend\models\Item */
/* @var $addSupplierModel frontend\models\Supplier */
Modal::begin([
    'id' => 'goodsPurchaseAddItemModal',
    'header' => '<h2>Tambah Barang' . '</h2>',
    'size' => MODAL::SIZE_LARGE,
]);
$form = ActiveForm::begin(['action' => str_replace("create", "ajax-save-item", $currentUrl), 'options' => ['id' => 'addItemActiveForm', 'data-pjax' => true,]]);
echo $this->render('addItemModal', ['form' => $form, 'model' => $addItemModel]);
ActiveForm::end();
Modal::end();

Modal::begin([
    'id' => 'goodsPurchaseAddSupplierModal',
    'header' => '<h2>Tambah Supplier' . '</h2>',
    'size' => MODAL::SIZE_LARGE,
]);
$form = ActiveForm::begin(['action' => str_replace("create", "ajax-save-supplier", $currentUrl), 'options' => ['id' => 'addSupplierActiveForm', 'data-pjax' => true,]]);
echo $this->render('addSupplierModal', ['form' => $form, 'model' => $addSupplierModel]);
ActiveForm::end();
Modal::end();
?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>

<?php $form = ActiveForm::begin([
    'id' => 'goods-purchase-form',
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
                    <?= Html::label("Nama Barang", "itemListLabel", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::button('<span class="glyphicon glyphicon-plus"></span>', ['class' => 'goodsPurchaseAddItemModalButton']); ?>
                    <?= Html::dropDownList("itemList", null, \frontend\models\Item::map(), ['id' => 'goodsPurchaseAddItem', 'class' => 'input-big form-control chosen-select', 'prompt' => '--Silahkan Pilih--']) ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label("Harga", "itemPriceLabel", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemPrice", null, ['id' => 'goodsPurchasePrice', 'class' => 'input-group form-control']); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label("Jumlah", "itemAmountLabel", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <?= Html::textInput("itemAmount", null, ['id' => 'goodsPurchaseAmount','class' => 'input-group form-control']); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label("Tgl Expire", "itemExpireDateLabel", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3 . ' wrapped-space']); ?>
                    <?= yii\jui\DatePicker::widget([
                            'name' => 'ItemExpiryDate',
                            'options' => [
                                'id' => 'goodsPurchaseExpiryDate',
                                'class' => 'form-control'
                            ],
                    ]) ?>
                </div>
                <?php \yii\widgets\Pjax::end(); ?>
                <div class="col-xs-12 col-md-2">
                    <?= Html::label(''); ?>
                    <?= Html::button('<span class="glyphicon glyphicon-plus"></span>Tambah', ['id' => 'goodsPurchaseAddItemButton', 'class' => 'btn btn-block btn-success']); ?>
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
                        <th width="15%" class="text-center">
                            Tgl Expire
                        </th>
                        <th width="10%" class="text-center">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->gpDetails as $keyD => $detail): ?>
                        <tr>
                            <td class="text-center"><?= ($keyD + 1) ?></td>
                            <td class="text-center"><?= $detail->item->i_name ?></td>
                            <td class="text-center"><?= sprintf("Rp. %s",$detail->gpd_price); ?></td>
                            <td class="text-center"><?= $detail->gpd_quantity ?></td>
                            <td class="text-center">
                                <?= sprintf("Rp. %s",$detail->gpd_price*$detail->gpd_quantity); ?>
                                <?= Html::hiddenInput("totalPrice",  $detail->gpd_price*$detail->gpd_quantity, ['data-cell' => "A$keyD"]); ?>
                            </td>
                            <td class="text-center"><?= $detail->gpd_expire_date ?></td>
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
                    <?= $form->field($model, "gp_invoice_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'subTotal', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-cell' => 'V1', 'data-formula' => 'SUM(A0:A999)', 'data-format' => '0,0'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'gp_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
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
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "gp_discount", ['template' => '{label}<div class="col-md-3">{input}<span class="help-inline col-xs-12"><span class="middle">{error}{hint}</span></span></div><div class="col-md-6"><div class="input-group"><div class="input-group-addon">Rp.</div><input readOnly class="text-right form-control" id="discountValue" value="0" data-cell="X1" data-formula="(Z1/100)*V1" data-format="0,0"></div></div>'])
                        ->textInput(['maxlength' => true, 'class' => 'form-control text-right', 'data-cell' => 'Z1'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <?php \yii\widgets\Pjax::begin(['id' => 'pjaxSupplierList']); ?>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "supplier_id", ['template' => '<div class="col-md-3 no-padding-right">{label} <button class="goodsPurchaseAddSupplierModalButton"><span class="glyphicon glyphicon-plus"></span></button></div><div class="col-md-9">{input}<span class="help-inline col-xs-12"><span class="middle">{error}{hint}</span></span></div>'])
                        ->dropDownList(\frontend\models\Supplier::map(), ['class' => 'input-big form-control chosen-select', 'prompt' => '--Silahkan Pilih--'])
                        ->label("Suplier"); ?>
                </div>
                <?php \yii\widgets\Pjax::end(); ?>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, "gp_ppn", ['template' => '{label}<div class="col-md-3">{input}<span class="help-inline col-xs-12"><span class="middle">{error}{hint}</span></span></div><div class="col-md-6"><div class="input-group"><div class="input-group-addon">Rp.</div><input readOnly class="text-right form-control" id="ppnValue" value="0" data-cell="Y1" data-formula="(Z2/100)*(V1-X1)" data-format="0,0"></div></div>'])
                        ->textInput(['maxlength' => true, 'class' => 'form-control text-right', 'data-cell' => 'Z2'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, "gp_payment_method", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->dropDownList($model->paymentTypeList, ['class' => 'input-big form-control chosen-select', 'prompt' => '--Silahkan Pilih--'])
                        ->label("Syarat", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'total', [
                        'addon' => ['prepend' => ['content' => 'Rp.']],
                        'template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT
                    ])
                        ->textInput(['maxlength' => true, 'class' => 'no-padding-left form-control text-right', 'readOnly' => true, 'data-cell' => 'T1', 'data-formula' => 'V1-X1+Y1', 'data-format' => '0,0'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'gp_due_date', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->widget(
                            DatePicker::className(), [
                                'options' => [
                                    'class' => 'form-control'
                                ],
                            ]
                        )
                        ->label("Jatuh Tempo", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, "gp_cashier", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true, 'value' => \frontend\models\Person::findOne(Yii::$app->user->identity->person_id)->name])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-md-6 pull-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-primary']) ?>
                </div>
            </div>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>
