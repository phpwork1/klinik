<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pekerjaan');
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type'=>'button',
        'title'=>Yii::t('app', 'Add Jobs'),
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
    'j_name',
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
