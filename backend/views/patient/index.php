<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use backend\assets\PatientIndexAsset;

PatientIndexAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pasien');
$this->params['breadcrumbs'][] = $this->title;
$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'view' => function ($url, $model) {
        Modal::begin([
            'id' => 'patientModal' . $model->id,
            'header' => '<h2>Detail Pasien Berobat' . '</h2>',
            'size' => Modal::SIZE_LARGE,
        ]);
        echo $this->render('patientDetailModal', ['model' => $model]);
        Modal::end();
        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', 'javascript:void(0)', ['id' => $model->id, 'class' => 'patientModalClicked btn-sm btn-info', 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
    }
]);

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
        'buttons' => $buttons,
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
