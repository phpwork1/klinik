<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/25/2017
 * Time: 10:48 AM
 */

use yii2assets\printthis;

/* @var $this yii\web\View */
/* @var $supplierList frontend\models\Supplier[] */

$this->title = Yii::t('app', 'Daftar Suplier');
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

<?php \yii\widgets\Pjax::begin(['id' => 'pjaxId']); ?>

<div class="box box-primary">
    <div class="box-body">
        <div class="container-fluid">
            <?php if (!empty($supplierList)): ?>
            <div class="row">
                <div class="pull-right">

                    <?= $printer ?>

                </div>
            </div>
            <div id="PrintThis">
                <div class="text-center">
                    <h3>Laporan Daftar Suplier</h3>
                    <h4>Dr. <?= $person->name ?></h4>
                    <h4><?= $person->address ?></h4>
                </div>

                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama Suplier</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Kontak</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($supplierList as $key => $value): ?>
                        <tr>
                            <td><?= ($key + 1) ?></td>
                            <td><?= $value->id ?></td>
                            <td><?= $value->s_name ?></td>
                            <td><?= $value->s_address ?></td>
                            <td><?= $value->s_phone_number?></td>
                            <td><?= $value->s_contact_person?></td>
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
