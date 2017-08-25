<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\AppConst;
use yii\jui\Tabs;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Registration */
/* @var $consultation backend\models\RConsultation */
/* @var $medicine backend\models\RMedicine */
/* @var $doctorAction backend\models\RDoctorAction */
/* @var $drugAllergiesModel backend\models\DrugAllergies */
/* @var $position int */
/* @var $searchModelRMedicine backend\models\RMedicineSearch */
/* @var $searchModelRmDetail backend\models\RmDetail */
/* @var $searchModelRDoctorAction backend\models\RDoctorActionSearch */
/* @var $searchModelRDiagnosis backend\models\RDiagnosisSearch */
/* @var $searchModelRegistrationSearch backend\models\RegistrationSearch */
/* @var $rmDetail backend\models\RmDetail */

\backend\assets\ProcessAsset::register($this);
$this->title = 'Proses Pemeriksaan: ' . $model->patient->p_name;
$currentUrl = Url::current();
Modal::begin([
    'id' => 'processDrugAllergiesModal',
    'header' => '<h2>Tambah Alergi Obat' . '</h2>',
]);
$form = ActiveForm::begin(['action' => str_replace("process/" . $model->id, "ajax-process-drug-allergies-save", $currentUrl), 'options' => ['id' => 'processDrugAllergiesActiveForm', 'data-pjax' => true,]]);
echo $this->render('drugAllergiesModal', ['form' => $form, 'model' => $drugAllergiesModel, 'registrationModel' => $model]);
ActiveForm::end();
Modal::end();

$baseUrl = Url::base();
?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>
<?php
$form = ActiveForm::begin(); ?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body table-responsive process-form">

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="col-xs-12 col-md-8">
                        <?= $form->field($model, "r_number", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true])
                            ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?= $form->field($model, "r_date", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'class' => 'form-control no-padding-right', 'readOnly' => true])
                            ->label(false); ?>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <?= $form->field($model->patient, "p_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true])
                            ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?= $form->field($model->patient->job, "j_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true])
                            ->label(false); ?>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <?= $form->field($model->patient, "p_dob", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true])
                            ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?= $form->field($model->patient, "p_gender", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textInput(['maxlength' => true, 'value' => $model->patient->getGenderType(), 'class' => 'form-control', 'disabled' => true])
                            ->label(false); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="col-xs-12">
                        <?= $form->field($model->patient, "p_address", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                            ->textarea(['maxlength' => true, 'class' => 'form-control', 'readOnly' => true, 'rows' => 2])
                            ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-md-3">
                            <?= Html::label("Alergi Obat"); ?>
                        </div>
                        <div class="col-md-9">
                            <div class="button-group ">
                                <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0)', [
                                    'class' => 'drugAllergiesModalButton btn btn-primary',
                                    'title' => 'Tambah Alergi',]) ?>
                                <?php Pjax::begin(['id' => 'pjaxProcessDrugAllergies']); ?>
                                <?php $data = $model->getDrugAllergiesData();
                                foreach ($data as $key => $value) : ?>
                                    <?= Html::a($value . ' <i class="small glyphicon glyphicon-remove"></i>', '#', ['data-id' => $key, 'class' => 'drugAllergiesButton btn btn-warning']) ?>
                                <?php endforeach; ?>
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($model, "r_checked")
                        ->hiddenInput(['value' => 1])->label(false) ?>
                    <?= Html::submitButton('<span class="glyphicon glyphicon-save"></span> Selesai Pemeriksaan', ['class' => 'btn btn-block btn-success btn-lg']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="box">
    <div class="box-body table-responsive process-form">
        <?= Tabs::widget([
            'items' => [
                [
                    'label' => 'Riwayat Perobatan',
                    'content' => $this->render('processSearch', ['searchModelRegistrationSearch' => $searchModelRegistrationSearch, 'patientId' => $model->patient_id, 'registrationModel' => $model]),
                    'active' => true,
                ],
                [
                    'label' => 'Pemeriksaan',
                    'content' => $this->render('processChecking', ['searchModelRDiagnosis' => $searchModelRDiagnosis, 'model' => $consultation, 'registration_id' => $model->id]),
                ],
                [
                    'label' => 'Terapi',
                    'content' => $this->render('processMedicine', ['rmDetail' => $rmDetail, 'searchModelRDoctorAction' => $searchModelRDoctorAction, 'searchModelRMedicine' => $searchModelRMedicine, 'searchModelRmDetail' => $searchModelRmDetail, 'position' => $position, 'doctorAction' => $doctorAction, 'medicine' => $medicine, 'registration_id' => $model->id]),
                ],
            ],
            'options' => ['tag' => 'div', 'id' => "tabs"],
            'itemOptions' => ['tag' => 'div'],
            'clientOptions' => ['collapsible' => false],
        ]) ?>
    </div>
</div>
