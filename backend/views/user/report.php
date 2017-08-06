<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['/site/report']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['report'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'employee_id',
        'format' => 'raw',
        'value' => 'employeeLink',
        'filter' => backend\models\Employee::map(),
    ],
    'username',
    'email:email',
    [
        'attribute' => 'role',
        'value' => 'roleName',
        'filter' => $searchModel->roles,
    ],
    [
        'attribute' => 'status',
        'value' => 'statusName',
        'filter' => $searchModel->statuses,
    ],
    [
        'attribute' => 'created_at',
        'format' => ['date', 'php:Y-m-d'],
    ],
    [
        'attribute' => 'updated_at',
        'format' => ['date', 'php:Y-m-d'],
    ],
];

$this->params['export'] = ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            //'target' => ExportMenu::TARGET_BLANK,
            'filename' => 'Report' . $this->title,
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
]);
