<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
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
    'religion_id',
    'job_id',
    'patient_id',
    'p_medical_number',
    // 'p_registration_date',
    // 'p_name',
    // 'p_pob',
    // 'p_dob',
    // 'p_gender',
    // 'p_address',
    // 'p_postal_code',
    // 'p_contact_number',
    // 'p_ref',
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
