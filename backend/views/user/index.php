<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$params = Yii::$app->request->queryParams['UserSearch'];
$p['UserSearch[gtrole]'] = 1000;
if (isset($params['ltrole'])) {
    $p['UserSearch[ltrole]'] = 999;
} else if (isset($params['gtrole'])) {
    $p['UserSearch[gtrole]'] = 1000;
} else {
    $p['UserSearch[gtrole]'] = 1000;
}
$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah', ['create'], [
        'type' => 'button',
        'title' => Yii::t('app', 'Tambah Users'),
        'class' => 'btn btn-success'
    ]) . ' ' .
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['index', key($p) => $p[key($p)]], [
        'data-pjax' => 0,
        'class' => 'btn btn-default',
        'title' => Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'person_id',
        'format' => 'raw',
        'value' => 'personLink',
        'filter' => backend\models\Person::map(),
    ],
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
    ['class' => 'yii\grid\ActionColumn',
        'header' => 'Actions',
        'template' => '{toggle-status} {update} {delete}',
        'buttons' => [
            'toggle-status' => function ($url, $model) {
                return Html::a('<i class="glyphicon glyphicon-tag"></i>', $url, ['class' => 'btn-sm btn-primary', 'title' => Yii::t('app', 'Toggle Status'), 'data' => ['method' => 'post', 'confirm' => 'Toggle Active / Inactive user?']]);
            },
            'update' => function ($url, $model) {
                return yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn-sm btn-warning', 'title' => Yii::t('yii', 'Ubah data item ini.'),]);
            },
            'delete' => function ($url, $model) {
                return yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Are you sure deleting this?']]);
            },
        ],
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
]);
