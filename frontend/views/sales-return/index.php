<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SalesReturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Retur Penjualan';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => 'Add Sales Returns',
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'sr_return_number',
    'sr_date',
    [
        'attribute' => 'sales_id',
        'value' => 'sales.s_invoice_number'
    ],
    'sr_buyer',
    'sr_total_return',
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'template' => '{update} {delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
