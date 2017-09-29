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
/* @var $salesList frontend\models\Sales[] */
/* @var $fromDate string */
/* @var $toDate string */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Daftar Penjualan Barang Internal');
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
            <?php if (!empty($salesList)): ?>
            <div class="row">
                <div class="pull-right">

                    <?= $printer ?>

                </div>
            </div>
            <div id="PrintThis">
                <div class="text-center">
                    <h3>Laporan Daftar Penjualan Internal</h3>
                    <h4>Dr. <?= $person->name ?></h4>
                    <h4><?= $person->address ?></h4>
                    <h4>Pada Tanggal : <?= sprintf("%s s.d %s", Yii::$app->formatter->asDate($fromDate, 'dd-MM-Y'), Yii::$app->formatter->asDate($toDate, 'dd-MM-Y')) ?></h4>
                </div>

                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Nota</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Total Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($salesList as $key => $value): ?>
                        <tr>
                            <td><?= ($key + 1) ?></td>
                            <td><?= $value->s_invoice_number ?></td>
                            <td><?= $value->s_date ?></td>
                            <td><?= $value->s_buyer ?></td>
                            <td><?= "Rp. " . number_format($value->s_total_paid) ?></td>
                        </tr>
                    <?php endforeach; ?>
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
