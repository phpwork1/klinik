<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\MedicineTherapyAsset;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

MedicineTherapyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\RMedicine */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
/* @var $searchModelRMedicine backend\models\RMedicineSearch */
$baseUrl = Url::base();
$currentUrl = Url::current();

$searchModelRMedicine->registration_id = $registration_id;
$dataProvider = $searchModelRMedicine->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['medicine-delete', 'id' => $model->id], ['class' => 'ajaxMedicineTherapyDelete btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini')]);
    },
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'id',
    [
        'attribute' => 'item_id',
        'value' => 'item.i_name',
        'filter' => Html::activeDropDownList($searchModelRMedicine, 'item_id', \frontend\models\Item::map(), ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
    ],
    'rmr_amount',
    [
        'attribute' => 'rmr_dosage_1',
        'value' => 'dosage_name',
    ],
    'rmr_ref',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>

<div class="box-body table-responsive medicine-therapy-form">
    <div>
        <?php Modal::begin([
            'id' => 'medicineModal',
            'header' => '<h2>Tambah Obat' . '</h2>',
            'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span> Tambah Obat', 'class' => 'btn btn-large btn-primary'],
            'size' => MODAL::SIZE_LARGE,
        ]); ?>
        <?php
        $form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-medicine-save", $currentUrl), 'options' => ['id' => 'medicineTherapyModalActiveForm', 'data-pjax' => true,]]);
        echo $this->render('medicineModal', ['form' => $form, 'model' => $model, 'registration_id' => $registration_id]);
        ActiveForm::end(); ?>

        <?php Modal::end(); ?>
    </div>
    <br/>
    <div>
        <?php \yii\widgets\Pjax::begin(['id' => 'pjaxMedicineTherapy']); ?>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModelRMedicine,
            'columns' => $gridColumns,
        ]);
        ?>
        <?php \yii\widgets\Pjax::end() ?>
    </div>
</div>