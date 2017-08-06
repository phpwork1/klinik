<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah', ['create'], [
        'type'=>'button',
        'title'=>Yii::t('app', 'Tambah Accounts'),
        'class'=>'btn btn-success'
    ]) . ' '.
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['index'], [
        'data-pjax'=>0,
        'class' => 'btn btn-default',
        'title'=>Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'category_id',
        'value' => 'category.name',
        'filter' => backend\models\AccountCategory::map(),
    ],
    'code',
    'name',
    [
        'attribute' => 'beginning_balance',
        'format' => ['decimal', 0],
        'headerOptions' => ['class' => 'text-right'],
        'contentOptions' => ['class' => 'text-right'],
        'footerOptions' => ['class' => 'text-right'],
    ],
     'created_at',
     'updated_at',
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
