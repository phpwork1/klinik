<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillFooterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bawah Struk');
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['/site/report']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh', ['report'], [
        'data-pjax'=>0,
        'class' => 'btn btn-default',
        'title'=>Yii::t('app', 'Reset Grid')
    ])
];

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'footer:ntext',
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
