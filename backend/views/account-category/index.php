<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kategori Akun');
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah', ['create'], [
        'type'=>'button',
        'title'=>Yii::t('app', 'Tambah Kategori Akun'),
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
        'attribute' => 'group_id',
        'value' => 'group.name',
        'filter' => \backend\models\AccountGroup::map(),
    ],
    'code',
    'name',
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'template' => '{update}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
