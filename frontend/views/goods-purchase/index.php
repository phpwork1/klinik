<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use frontend\assets\GoodsPurchaseIndexAsset;

GoodsPurchaseIndexAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GoodsPurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembelian Barang';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => 'Add Goods Purchases',
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'view' => function ($url, $model) {
        Modal::begin([
            'id' => 'goodsPurchaseIndexViewModal',
            'header' => '<h2>Lihat Transaksi No Faktur: ' . $model->gp_invoice_number . '</h2>',
            'size' => MODAL::SIZE_LARGE,
        ]);
        echo $this->render('indexViewItemModal', ['model' => $model]);
        Modal::end();
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', 'javascript:void(0)', ['class' => 'btn-sm btn-info goodsPurchaseIndexViewModalButton', 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
    },
]);



$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'gp_invoice_number',
    [
        'attribute' => 'gp_date',
        'value' => 'gp_date',
        'filter' => \yii\jui\DatePicker::widget([
            'model' => $searchModel,
            'language' => 'id',
            'dateFormat' => 'dd-MM-yyyy',
            'attribute' => 'gp_date',
            'options' => ['class' => 'form-control'],
        ]),
    ],
    [
        'attribute' => 'supplier_id',
        'value' => 'supplier.s_name',
        'filter' => Html::activeDropDownList($searchModel, 'supplier_id', \frontend\models\Supplier::map(), ['prompt' => '--Silahkan Pilih--', 'class' => 'chosen-select form-control'])
    ],
    [
        'attribute' => 'gp_payment_method',
        'value' => 'paymentName',
        'filter' => Html::activeDropDownList($searchModel, 'gp_payment_method', $searchModel->paymentTypeList, ['prompt' => '--Silahkan Pilih--', 'class' => 'chosen-select form-control'])
    ],
    [
        'attribute' => 'totalView',
        'label' => 'Total Harga',
    ],
        // 'gp_discount',
        // 'gp_ppn',
        // 'gp_cashier',
    ['class' => 'yii\grid\ActionColumn',
    'header' => 'Actions',
    'template' => '{view} {update} {delete}',
    'contentOptions' => ['class' => 'text-nowrap'],
        'buttons' => $buttons,
],
    ];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
