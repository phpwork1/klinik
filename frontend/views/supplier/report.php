<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
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
        'header' => 'Actions',
        'template' => '{view}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

$this->params['export'] = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    //'target' => ExportMenu::TARGET_BLANK,
    'filename' => 'Report ' . $this->title,
    'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-default'
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'showFooter' => TRUE,
]);
