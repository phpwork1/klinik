<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GoodsPurchaseReturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Retur Pembelian';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type'=>'button',
        'title'=>'Add Goods Purchase Returns',
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
    'gpr_return_number',
    [
        'attribute' => 'goods_purchase_id',
        'value' => 'goodsPurchase.gp_invoice_number'
    ],
    'gpr_date',
    'gpr_supplier_name',
    'gpr_total_return',
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
