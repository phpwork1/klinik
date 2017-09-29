<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/25/2017
 * Time: 10:48 AM
 */

use kartik\form\ActiveForm;
use yii2assets\printthis;
use yii\helpers\Html;
use common\components\helpers\AppConst;

/* @var $this yii\web\View */
/* @var $itemCategory frontend\models\ItemCategory[] */
/* @var $itemList frontend\models\Item[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $toDate String */
/* @var $fromDate String */

$this->title = Yii::t('app', 'Laporan Stock Barang');
$this->params['breadcrumbs'][] = $this->title;

$printer = printthis\PrintThis::widget([
    'htmlOptions' => [
        'id' => 'PrintThis',
        'btnClass' => 'btn btn-info',
        'btnId' => 'btnPrintThis',
        'btnText' => 'Cetak',
        'btnIcon' => 'fa fa-print'
    ],
    'options' => [
        'debug' => false,
        'importCSS' => true,
        'importStyle' => false,
        'pageTitle' => "",
        'removeInline' => true,
        'printDelay' => 333,
        'header' => null,
        'formValues' => true,
    ]
]);

$person = \backend\models\Person::findOne(Yii::$app->user->identity->person_id);

?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

<div class="box box-primary">
    <div class="box-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?= Html::label("Kategori Barang", "itemCategoryList", ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    <div class="col-md-9">
                        <?= Html::dropDownList("itemCategoryList", null, $itemCategory, ['class' => 'chosen-select form-control', 'prompt' => '--Semua Kategori Barang--']) ?>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-6">
                    <?= Html::label("Pada Tanggal", "fromDate", ['class' => 'col-md-2 no-padding-right']); ?>
                    <div class="col-md-4">
                        <?= yii\jui\DatePicker::widget([
                            'name' => 'fromDate',
                            'options' => [
                                'class' => 'form-control'
                            ],
                            'value' => time(),
                        ]) ?>
                    </div>
                    <?= Html::label("s.d", "toDate", ['class' => 'col-md-2 no-padding-right']); ?>
                    <div class="col-md-4">
                        <?= yii\jui\DatePicker::widget([
                            'name' => 'toDate',
                            'options' => [
                                'class' => 'form-control',
                            ],
                            'value' => time(),
                        ]) ?>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-print"></span> Cetak', ['class' => 'btn btn-info']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php \yii\widgets\Pjax::begin(['id' => 'pjaxId']); ?>

<div class="box box-primary">
    <div class="box-body">
        <div class="container-fluid">
            <?php if (!empty($itemList)): ?>
            <div class="row">
                <div class="pull-right">

                    <?= $printer ?>

                </div>
            </div>
            <div id="PrintThis">
                <div class="text-center">
                    <h3>Laporan Stock Barang</h3>
                    <h4>Dr. <?= $person->name ?></h4>
                    <h4><?= $person->address ?></h4>
                    <h4>Pada Tanggal : <?= sprintf("%s s.d %s", Yii::$app->formatter->asDate($fromDate, 'dd-MM-Y'), Yii::$app->formatter->asDate($toDate, 'dd-MM-Y')) ?></h4>
                </div>

                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stock</th>
                        <th>Harga Beli</th>
                        <th>HNa+PPn</th>
                        <th>Harga Jual</th>
                        <th>HET</th>
                        <th>Harga Racik</th>
                        <th>Expire Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($itemList as $key => $value): ?>
                        <tr>
                            <td><?= ($key + 1) ?></td>
                            <td><?= $value->id ?></td>
                            <td><?= $value->i_name ?></td>
                            <td><?= $value->i_unit ?></td>
                            <td><?= $value->i_stock_amount ?></td>
                            <td>Rp. <?= number_format($value->i_buy_price, 0, '.', ',') ?></td>
                            <td><?= $value->i_ppn ?></td>
                            <td>Rp. <?= number_format($value->i_sell_price, 0, '.', ',') ?></td>
                            <td>Rp. <?= number_format($value->i_retail_price) ?></td>
                            <td>Rp. <?= number_format($value->i_blend_price) ?></td>
                            <td><?= Yii::$app->formatter->asDate($value->i_expired_date,'dd-MM-Y') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
