<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\assets\SalesIndexAsset;
use yii\bootstrap\Modal;

SalesIndexAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchRegistrationModel backend\models\RegistrationSearch */
/* @var $dataRegistrationProvider yii\data\ActiveDataProvider */
/* @var $type int */
/* @var $title string */

$this->title = 'Penjualan ' . $title;
if($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) {
    $this->params['buttons'] = [
        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create', 'type' => $type], [
            'type' => 'button',
            'title' => 'Add Sales',
            'class' => 'btn btn-success'
        ]) . ' ' .
        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
            'data-pjax' => 0,
            'class' => 'btn btn-default',
            'title' => Yii::t('app', 'Reset Grid')
        ])
    ];
}

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'view' => function ($url, $model) {
        Modal::begin([
            'id' => 'salesIndexViewModal' .  $model->id,
            'header' => '<h2>Lihat Penjualan No Faktur: ' . $model->s_invoice_number . '</h2>',
            'size' => MODAL::SIZE_LARGE,
        ]);
        echo $this->render('indexViewItemModal', ['model' => $model, 'type' => 1]);
        Modal::end();
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', 'javascript:void(0)', ['class' => 'btn-sm btn-info salesIndexViewModalButton', 'data-id' => $model->id, 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
    },
    'update' => function ($url, $model) {
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'type' => 1, 'id' => $model->id], ['class' => 'btn-sm btn-warning', 'title' => Yii::t('yii', 'Ubah data item ini.'),]);
    },
    'delete' => function ($url, $model) {
        return yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', ['delete', 'type' => 1, 'id' => $model->id], ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Yakin ingin menghapus data ini?']]);
    },
]);

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    's_invoice_number',
    's_date',
    's_buyer',
    's_total_paid',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{view} {update} {delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

if($type == \frontend\controllers\SalesController::SALES_TYPE_INTERNAL){
    $actionColumn = Yii::$container->get('yii\grid\ActionColumn');
    $buttons = array_merge($actionColumn->buttons, [
        'process' => function ($url, $model) {
            return Html::a('<span class="green"><i class="glyphicon glyphicon-arrow-right"></i></span>', ['create', 'type' => 2, 'registrationId' => $model->id], ['class' => 'btn-sm btn-primary']);
        },
    ]);

    $gridColumnsRegistration = [
        ['class' => 'yii\grid\SerialColumn'],
        'r_number',
        [
            'attribute' => 'r_date',
            'value' => 'r_date',
            'filter' => \yii\jui\DatePicker::widget([
                'model' => $searchRegistrationModel,
                'language' => 'id',
                'dateFormat' => 'dd-MM-yyyy',
                'attribute' => 'r_date',
                'options' => ['class' => 'form-control'],
            ]),
        ],
        [
            'attribute' => 'patient_id',
            'value' => 'patient.p_name',
            'label' => 'Nama Pasien',
            'filter' => Html::activeDropDownList($searchRegistrationModel, 'patient_id', \backend\models\Patient::map(), ['class' => 'chosen-select form-control'])
        ],
        [
            'attribute' => 'r_position',
            'value' => 'r_position_desc',
            'filter' => Html::activeDropDownList($searchRegistrationModel, 'r_position', $searchRegistrationModel->actionList, ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
        ],
        ['class' => 'yii\grid\ActionColumn',
            'buttons' => $buttons,
            'header' => 'Actions',
            'template' => '{process}',
            'contentOptions' => ['class' => 'text-nowrap'],
        ],
    ];

    echo GridView::widget([
        'dataProvider' => $dataRegistrationProvider,
        'filterModel' => $searchRegistrationModel,
        'columns' => $gridColumnsRegistration,
    ]);

    $actionColumn = Yii::$container->get('yii\grid\ActionColumn');
    $buttons = array_merge($actionColumn->buttons, [
        'view' => function ($url, $model) {
            Modal::begin([
                'id' => 'salesIndexViewModal' . $model->id,
                'header' => '<h2>Lihat Penjualan No Faktur: ' . $model->s_invoice_number . '</h2>',
                'size' => MODAL::SIZE_LARGE,
            ]);
            echo $this->render('indexViewItemModal', ['model' => $model, 'type' => 2]);
            Modal::end();
            return yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', 'javascript:void(0)', ['class' => 'btn-sm btn-info salesIndexViewModalButton', 'data-id' => $model->id, 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
        },
        'update' => function ($url, $model) {
            return yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'type' => 2, 'registrationId' => $model->salesTypes[0]->registration_id, 'id' => $model->id], ['class' => 'btn-sm btn-warning', 'title' => Yii::t('yii', 'Ubah data item ini.'),]);
        },
        'delete' => function ($url, $model) {
            return yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', ['delete', 'type' => 2, 'id' => $model->id], ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Yakin ingin menghapus data ini?']]);
        },
    ]);

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        's_invoice_number',
        's_date',
        's_buyer',
        's_total_paid',
        ['class' => 'yii\grid\ActionColumn',
            'buttons' => $buttons,
            'header' => 'Actions',
            'template' => '{view} {update} {delete}',
            'contentOptions' => ['class' => 'text-nowrap'],
        ],
    ];

}

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
