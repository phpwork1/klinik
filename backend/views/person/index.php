<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');

$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        'type' => 'button',
        'title' => Yii::t('app', 'Add People'),
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'name',
    'address',
    'email:email',
    'mobile',
    'phone',
    'whatsapp',
    'fb',
    'emergency_contact_name',
    'emergency_contact_number',
    // 'bbm',
    // 'line',
    // 'skype',
    // 'photo',
    // 'created_at',
    // 'created_by',
    // 'updated_at',
    // 'updated_by',
    // 'deleted_at',
    // 'deleted_by',
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'template' => '{view} {update} {delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
Pjax::end();