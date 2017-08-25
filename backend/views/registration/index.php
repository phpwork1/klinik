<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelAfterCheck backend\models\RegistrationSearch */
/* @var $dataProviderAfterCheck yii\data\ActiveDataProvider */

$this->title = 'Registrasi';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => 'Add Registrations',
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];
$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'process' => function ($model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-arrow-right"></i></span>', ['process', 'id' => $model->id], ['class' => 'btn-sm btn-primary']);
    },
]);

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'r_number',
    [
        'attribute' => 'r_date',
        'value' => 'r_date',
        'filter' => \yii\jui\DatePicker::widget([
            'model' => $searchModel,
            'language' => 'id',
            'dateFormat' => 'dd-MM-yyyy',
            'attribute' => 'r_date',
            'options' => ['class' => 'form-control'],
        ]),
    ],
    [
        'attribute' => 'patient_id',
        'value' => 'patient.p_name',
        'label' => 'Nama Pasien',
        'filter' => Html::activeDropDownList($searchModel, 'patient_id', \backend\models\Patient::map(), ['class' => 'chosen-select form-control'])
    ],
    [
        'attribute' => 'r_position',
        'value' => 'r_position_desc',
        'filter' => Html::activeDropDownList($searchModel, 'r_position', $searchModel->actionList, ['class' => 'chosen-select form-control', 'prompt' => '--Silahkan Pilih--'])
    ],
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{update} {delete} {process}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];
?>
<div class=box>
    <div class="box-header with-border">
        <h3 class="box-title">Registrasi Pasien</h3>
    </div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]);
    ?>

</div>
<div class=box>
    <div class="box-header with-border">
        <h3 class="box-title">Pasien Telah Diperiksa</h3>
    </div>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProviderAfterCheck,
        'filterModel' => $searchModelAfterCheck,
        'columns' => $gridColumns,
    ]);
    ?>

</div>