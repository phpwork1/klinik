<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    's_invoice_number',
    's_date',
    's_buyer',
    's_total_paid',
    ['class' => 'yii\grid\ActionColumn',
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
}

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
