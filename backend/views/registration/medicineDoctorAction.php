<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use backend\assets\MedicineDoctorActionAsset;

MedicineDoctorActionAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\RDoctorAction */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
/* @var $position int */
/* @var $searchModelRDoctorAction backend\models\RDoctorActionSearch */
/* @var $searchModelRmDetail backend\models\RmDetailSearch */

$currentUrl = Url::current();
$searchModelRDoctorAction->registration_id = $registration_id;
$dataProvider = $searchModelRDoctorAction->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['doctor-action-delete', 'id' => $model->id], ['class' => 'ajaxMedicineDoctorActionDelete btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini')]);
    },
]);

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'rda_name',
    ],
    'rda_price',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

$searchModelRmDetail->registration_id = $registration_id;
$dataProviderDetail = $searchModelRmDetail->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['medicine-detail-delete', 'id' => $model->id, 'registration_id' => $model->registration_id], ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Yakin ingin menghapus data ini?']]);
    },
]);

$gridColumnsDetail = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'r_medicine_id',
        'value' => 'rMedicine.item.i_name',
        'group' => true,
        'filter' => Html::activeDropDownList($searchModelRmDetail, 'r_medicine_id', \backend\models\RMedicine::mapWithItem(null, 'item_id', ['i.i_blended' => true, 'registration_id' => $registration_id]), ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'item_id',
        'value' => 'item.i_name',
        'filter' => Html::activeDropDownList($searchModelRmDetail, 'item_id', \frontend\models\Item::map(), ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'rmd_amount',
    ],
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];
?>

<div class="box-body table-responsive medicine-blended-therapy-form">
    <div>
        <?php Modal::begin([
            'id' => 'medicineDoctorActionModal',
            'header' => '<h2>Tambah Tindakan Dokter' . '</h2>',
            'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span> Tambah Tindakan Dokter', 'class' => 'btn btn-large btn-primary'],
            'size' => MODAL::SIZE_LARGE,
        ]); ?>
        <?php
        $form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-medicine-doctor-action-save", $currentUrl), 'options' => ['id' => 'medicineDoctorActionActiveForm', 'data-pjax' => true,]]);
        echo $this->render('medicineDoctorActionModal', ['position' => $position, 'form' => $form, 'model' => $model, 'registration_id' => $registration_id]);
        ?>
        <?php ActiveForm::end(); ?>
        <?php Modal::end(); ?>
    </div>
    <br/>
    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxMedicineDoctorAction']) ?>
    <div>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModelRDoctorAction,
            'columns' => $gridColumns,
        ]);
        ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>

    <div class="pull-right">
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['id' => 'pjaxMedicineDetailDoctorActionRefresh', 'class' => 'btn btn-info btn-lg']); ?>
    </div>
    <br/>
    <br/>
    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxMedicineDetailDoctorAction']); ?>
    <div>
        <?php echo kartik\grid\GridView::widget([
            'dataProvider' => $dataProviderDetail,
            'filterModel' => $searchModelRmDetail,
            'columns' => $gridColumnsDetail,
        ]);
        ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>