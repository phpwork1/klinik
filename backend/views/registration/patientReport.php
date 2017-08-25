<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\DatePicker;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use backend\assets\ProcessSearchAsset;

ProcessSearchAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Pasien Berobat';
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
?>

<div class="box-body table-responsive diagnosis-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($searchModel, 'dateFrom', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->widget(
                            DatePicker::className(), [
                                'options' => [
                                    'class' => 'form-control'
                                ],
                            ]
                        )
                        ->label('Dari Tanggal', ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
                    ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($searchModel, 'dateTo', ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->widget(
                            DatePicker::className(), [
                                'options' => [
                                    'class' => 'form-control'
                                ],
                            ]
                        )
                        ->label('Ke Tanggal', ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
                    ?>
                </div>
            </div>
            <div class="col-xs-12">
                <?= Html::submitButton('<span class="glyphicon glyphicon-print"> </span> Cetak', ['class' => 'btn btn-block btn-primary btn-lg']) ?>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>
    <br/>
    <div class="box">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
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
                ],
                'r_patient_tension',
                'r_patient_temp',
                'r_complaint',
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => $buttons,
                    'header' => 'Actions',
                    'template' => '{view}',
                    'contentOptions' => ['class' => 'text-nowrap'],
                ],
            ],
        ]);
        ?>
    </div>
</div>
