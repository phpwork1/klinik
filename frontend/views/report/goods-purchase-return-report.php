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

/* @var $this yii\web\View */
/* @var $supplierList frontend\models\Supplier[] */
/* @var $goodsPurchaseReturnList frontend\models\GoodsPurchaseReturn[] */
/* @var $fromDate string */
/* @var $toDate string */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Daftar Retur Pembelian');
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

$totalReturn = 0;
?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

<div class="box box-primary">
    <div class="box-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?= Html::label("Suplier", "supplierList", ['class' => 'col-md-2 no-padding-right']); ?>
                    <div class="col-md-10">
                        <?= Html::dropDownList("supplierList", null, $supplierList, ['class' => 'chosen-select form-control', 'prompt' => '--Semua Suplier--']) ?>
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
            <?php if (!empty($goodsPurchaseReturnList)): ?>
            <div class="row">
                <div class="pull-right">

                    <?= $printer ?>

                </div>
            </div>
            <div id="PrintThis">
                <div class="text-center">
                    <h3>Laporan Retur Pembelian</h3>
                    <h4>Dr. <?= $person->name ?></h4>
                    <h4><?= $person->address ?></h4>
                    <h4>Pada Tanggal : <?= sprintf("%s s.d %s", Yii::$app->formatter->asDate($fromDate, 'dd-MM-Y'), Yii::$app->formatter->asDate($toDate, 'dd-MM-Y')) ?></h4>
                </div>

                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Retur</th>
                        <th>Tanggal</th>
                        <th>No Faktur</th>
                        <th>Nama Suplier</th>
                        <th>Total Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($goodsPurchaseReturnList as $key => $value): ?>
                        <tr>
                            <td><?= ($key + 1) ?></td>
                            <td><?= $value->gpr_return_number ?></td>
                            <td><?= $value->gpr_date ?></td>
                            <td><?= $value->goodsPurchase->gp_invoice_number ?></td>
                            <td><?= $value->goodsPurchase->supplier->s_name ?></td>
                            <td><?= "Rp. " . number_format($value->gpr_total_return) ?></td>
                            <?php $totalReturn+=$value->gpr_total_return; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" class="text-center">Total</td>
                        <td>Rp. <?= number_format($totalReturn) ?></td>
                    </tr>
                    </tbody>
                </table>
                <?php elseif(($fromDate) != ''): ?>
                    <div class="text-center">
                        Tidak Ada Data
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
