<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pasien');
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type'=>'button',
        'title'=>Yii::t('app', 'Add Patients'),
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
    'p_medical_number',
    'p_name',
    'p_pob',
    [
        'attribute' => 'p_dob',
        'value' => 'p_dob',
        'filter' => \yii\jui\DatePicker::widget([
            'model' => $searchModel,
            'language' => 'id',
            'dateFormat' => 'dd-MM-yyyy',
            'attribute' => 'p_dob',
            'options' => ['class' => 'form-control'],
        ]),
    ],
    [
        'attribute' => 'religion_id',
        'value' => 'religion.r_name',
        'filter' => Html::activeDropDownList($searchModel, 'religion_id', \backend\models\Religion::map(), ['class' => 'chosen-select form-control'])
    ],
    [
        'attribute' => 'job_id',
        'value' => 'job.j_name',
        'filter' => Html::activeDropDownList($searchModel, 'job_id', \backend\models\Job::map(), ['class' => 'chosen-select form-control'])
    ],

    'p_address',
    'p_contact_number',
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
