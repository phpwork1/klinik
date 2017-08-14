<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type'=>'button',
        'title'=>'Add Items',
        'class'=>'btn btn-success'
    ]) . ' '.
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'data-pjax'=>0,
        'class' => 'btn btn-default',
        'title'=>Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
['class' => 'yii\grid\SerialColumn'],
    'id',
    'i_name',
    'i_description:ntext',
    'i_factory',
    'i_unit',
    'i_buy_price',
    'i_ppn',
    'i_retail_price',
    //'i_net_price',
    'i_sell_price',
    'i_blend_price',
    'i_stock_amount',
    // 'i_stock_min',
    // 'i_stock_max',
    [
        'attribute' => 'item_category_id',
        'value' => 'itemCategory.ic_name',
        'filter' => Html::activeDropDownList($searchModel, 'item_category_id', \frontend\models\ItemCategory::map(), ['class' => 'chosen-select form-control'])
    ],
    [
        'attribute' => 'i_expired_date',
        'value' => 'i_expired_date',
        'filter' => \yii\jui\DatePicker::widget([
            'model' => $searchModel,
            'language' => 'id',
            'dateFormat' => 'dd-MM-yyyy',
            'attribute' => 'i_expired_date',
            'options' => ['class' => 'form-control'],
        ]),
    ],
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'template' => '{view} {update} {delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
        ],
    ];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
