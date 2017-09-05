<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\assets\MedicineBlendedTherapyAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

MedicineBlendedTherapyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\RMedicine */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
/* @var $searchModelRMedicine backend\models\RMedicineSearch */
/* @var $searchModelRmDetail backend\models\RmDetailSearch */
/* @var $rmDetail backend\models\RmDetail */

$currentUrl = Url::current();
$searchModelRMedicine->registration_id = $registration_id;
$searchModelRMedicine->i_blended = true;
$dataProvider = $searchModelRMedicine->searchBlended(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['medicine-delete', 'id' => $model->id], ['class' => 'ajaxMedicineBlendedDelete btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini')]);
    },
    'detail' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-plus"></i></span>', 'javascript:void(0)', ['data' => $model->id, 'class' => 'medicineBlendedModalClicked btn-sm btn-primary']);
    },
]);

Modal::begin([
    'id' => 'medicineBlendedDetailModal',
    'header' => '<h2>Tambah Bahan Racikan' . '</h2>',
]);
$form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-medicine-detail-save", $currentUrl), 'options' => ['id' => 'medicineDetailActiveForm', 'data-pjax' => true,]]);
echo Html::hiddenInput('RmDetail[r_medicine_id]', null, ['id' => 'modelId']);
echo $this->render('medicineDetailModal', ['form' => $form, 'model' => $rmDetail, 'registration_id' => $registration_id]);
ActiveForm::end();
Modal::end();

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'item_id',
        'value' => 'item.i_name',
        'filter' => Html::activeDropDownList($searchModelRMedicine, 'item_id', \frontend\models\Item::map(), ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
    ],
    [
        'attribute' => 'rmr_amount',
    ],
    [
        'attribute' => 'rmr_dosage_1',
        'value' => 'dosage_name',
    ],
    'rmr_ref',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{delete}{detail}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

$searchModelRmDetail->registration_id = $registration_id;
$dataProviderDetail = $searchModelRmDetail->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['medicine-detail-delete', 'id' => $model->id], ['class' => 'ajaxMedicineDetailDelete btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini')]);
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
            'id' => 'medicineBlendedModal',
            'header' => '<h2>Tambah Obat Racikan' . '</h2>',
            'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span> Tambah Obat Racikan', 'class' => 'btn btn-large btn-primary'],
            'size' => MODAL::SIZE_LARGE,
        ]); ?>
        <?php
        $form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-medicine-blended-save", $currentUrl), 'options' => ['id' => 'medicineBlendedActiveForm', 'data-pjax' => true,]]);
        echo $this->render('medicineBlendedModal', ['form' => $form, 'model' => $model, 'registration_id' => $registration_id]);
        ?>
        <?php ActiveForm::end(); ?>
        <?php Modal::end(); ?>
    </div>
    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxMedicineBlended']); ?>
    <div>
        <br/>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModelRMedicine,
            'columns' => $gridColumns,
        ]);
        ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxMedicineDetail']); ?>
    <div>
        <br/>
        <?php echo kartik\grid\GridView::widget([
            'dataProvider' => $dataProviderDetail,
            'filterModel' => $searchModelRmDetail,
            'columns' => $gridColumnsDetail,

        ]);
        ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>