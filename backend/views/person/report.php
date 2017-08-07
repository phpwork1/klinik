<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
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
    'name',
    'address',
    'district_id',
    'regency_id',
    // 'province_id',
    // 'country_id',
    // 'birth_date',
    // 'gender',
    // 'religion',
    // 'marriage_status',
    // 'nationality',
    // 'educational_level',
    // 'dicipline',
    // 'profession',
    // 'majoring',
    // 'email:email',
    // 'mobile',
    // 'phone',
    // 'whatsapp',
    // 'fb',
    // 'bbm',
    // 'line',
    // 'skype',
    // 'emergency_contact_name',
    // 'emergency_contact_number',
    // 'photo',
    // 'created_at',
    // 'created_by',
    // 'updated_at',
    // 'updated_by',
    // 'deleted_at',
    // 'deleted_by',
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
