<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use backend\assets\ProcessCheckingAsset;
use yii\helpers\Url;

ProcessCheckingAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\RConsultation */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
/* @var $searchModelRDiagnosis backend\models\RDiagnosisSearch */

$currentUrl = Url::current();

$searchModelRDiagnosis->registration_id = $registration_id;
$dataProvider = $searchModelRDiagnosis->search(Yii::$app->request->queryParams);

$actionColumn = Yii::$container->get('yii\grid\ActionColumn');
$buttons = array_merge($actionColumn->buttons, [
    'delete' => function ($url, $model) {
        return Html::a('<span class="green"><i class="glyphicon glyphicon-remove"></i></span>', ['diagnosis-delete', 'id' => $model->id], ['class' => 'ajaxProcessCheckingDiagnosisDeleteButton btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini')]);
    },
]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'rd_name',
    ['class' => 'yii\grid\ActionColumn',
        'buttons' => $buttons,
        'header' => 'Actions',
        'template' => '{delete}',
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
];
?>

<div class="box-body table-responsive consultation-form">
    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxConsultationForm']); ?>
    <?php $form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-process-checking-save", $currentUrl), 'options' => ['id' => 'processCheckingActiveForm', 'data-pjax' => true,]]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <?= $form->field($model, "c_history", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => 2])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, "c_support", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => 2])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <?= $form->field($model, "c_description", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textarea(['maxlength' => true, 'class' => 'form-control', 'rows' => 2])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= $form->field($model, "c_td_value", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= $form->field($model, "c_pr_value", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= $form->field($model, "c_t_value", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <?= $form->field($model, "c_rr_value", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, "c_control_days", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                <div class="col-xs-12">
                    <?= $form->field($model, "registration_id")
                        ->hiddenInput(['value' => $registration_id])->label(false) ?>
                    <?= Html::submitButton('<span class="glyphicon glyphicon-save"></span> Simpan', ['class' => 'btn btn-block btn-success btn-lg']) ?>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end(); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php
            Modal::begin([
                'id' => 'processCheckingDiagnosisModal',
                'header' => '<h2>Tambah Diagnosis</h2>',
                'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span> Tambah Diagnosis', 'class' => 'btn btn-block btn-info btn-lg'],
            ]);
            $diagnosisModel = new \backend\models\RDiagnosis();
            $form = ActiveForm::begin(['action' => str_replace("process/" . $registration_id, "ajax-process-checking-diagnosis-save", $currentUrl), 'options' => ['id' => 'processCheckingDiagnosisActiveForm', 'data-pjax' => true,]]);
            echo $this->render('diagnosisModal', ['form' => $form, 'registrationId' => $registration_id, 'model' => $diagnosisModel]);
            ActiveForm::end();
            Modal::end();
            ?>
        </div>
    </div>

    <?php \yii\widgets\Pjax::begin(['id' => 'pjaxRDiagnosis']); ?>
    <div>
        <br/>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModelRDiagnosis,
            'columns' => $gridColumns,
        ]);
        ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
