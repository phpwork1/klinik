<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'download' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-download"></i></span>', ['download', 'id' => $model->id], ['class' => 'btn-sm btn-primary']);
    },
]);

$this->title = 'Daftar Suplier';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type'=>'button',
        'title'=>'Add Suppliers',
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
    's_name',
    's_address:ntext',
    's_phone_number',
    's_contact_person',
    // 's_file',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{view} {update} {delete} {download}',
        'contentOptions' => ['class' => 'text-nowrap'],
        ],
    ];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
