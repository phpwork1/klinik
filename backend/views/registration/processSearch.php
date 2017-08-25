<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use backend\assets\ProcessSearchAsset;

ProcessSearchAsset::register($this);
/* @var $this yii\web\View */
/* @var $patientId integer */
/* @var $registrationModel backend\models\Registration */
/* @var $searchModelRegistrationSearch backend\models\RegistrationSearch */


$searchModelRegistrationSearch = new \backend\models\RegistrationSearch();
$searchModelRegistrationSearch->r_checked = true;
$searchModelRegistrationSearch->patient_id = $patientId;
$dataProvider = $searchModelRegistrationSearch->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'view' => function ($model) {
        Modal::begin([
            'id' => 'processSearchModal' . $model->id,
            'header' => '<h2>Detail Registrasi Pasien' . '</h2>',
            'size' => Modal::SIZE_LARGE,
        ]);
        echo $this->render('view', ['model' => $model]);
        Modal::end();
        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', 'javascript:void(0)', ['id' => $model->id, 'class' => 'processSearchModalClicked btn-sm btn-info', 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
    }
]);


$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'r_number',
    [
        'attribute' => 'r_date',
        'value' => 'r_date',
        'filter' => \yii\jui\DatePicker::widget([
            'model' => $searchModelRegistrationSearch,
            'language' => 'id',
            'dateFormat' => 'dd-MM-yyyy',
            'attribute' => 'r_date',
            'options' => ['class' => 'form-control'],
        ]),
    ],
    'r_patient_weight',
    'r_patient_tension',
    'r_patient_temp',
    'r_complaint',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{view}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];
?>
<?php
\yii\widgets\Pjax::begin(['id' => 'pjaxProcessSearch']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModelRegistrationSearch,
    'columns' => $gridColumns,
]);
\yii\widgets\Pjax::end();
?>
