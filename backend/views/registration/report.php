<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrations';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'id',
    'patient_id',
    'r_number',
    'r_date',
    'r_patient_weight',
    // 'r_patient_tension',
    // 'r_patient_temp',
    // 'r_complaint:ntext',
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
