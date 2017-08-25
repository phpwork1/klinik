<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Registration */
?>
<div class="box box-info">
    <div class="box-body event-type-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <?= Html::label('Anamnesi', 'history', ['class' => 'col-xs-12 no-padding-left']) ?>
                    <?= Html::textarea("history", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_history : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <?= Html::label('Diagnosis') ?>
                    <ol>
                        <?php foreach ($model->rDiagnoses as $key => $value) : ?>
                            <li>
                                <small><?= $value->rd_name ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="col-xs-12 no-padding-left">
                        <br/>
                        <?= Html::label('Pemeriksaan') ?>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="col-md-3 no-padding">
                            <?= Html::label('TD') ?>
                        </div>
                        <div class="col-md-9">
                            <?= Html::textinput("checking", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_td_value : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="col-md-3 no-padding">
                            <?= Html::label('TR') ?>
                        </div>
                        <div class="col-md-9">
                            <?= Html::textinput("checking", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_pr_value : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="col-md-3 no-padding">
                            <?= Html::label('To') ?>
                        </div>
                        <div class="col-md-9">
                            <?= Html::textinput("checking", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_t_value : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="col-md-3 no-padding">
                            <?= Html::label('RR') ?>
                        </div>
                        <div class="col-md-9">
                            <?= Html::textinput("checking", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_rr_value : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                        </div>
                    </div>

                    <div class="col-xs-12 no-padding">
                        <br/>
                        <?= Html::textarea("checking", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_description : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <?= Html::label('Therapi') ?>
                    <ol>
                        <?php foreach ($model->rMedicines as $key => $value) : ?>
                            <li>
                                <small><?= sprintf("%s >> %s (%s X %s %s) >> %s", $value->item->i_name, $value->rmr_amount, $value->rmr_dosage_1, $value->rmr_dosage_2, $value->rmr_dosage_3, $value->rmr_ref); ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <br/>
                    <?= Html::label('Pemeriksaan Penunjang', 'support', ['class' => 'col-xs-12 no-padding-left']) ?>
                    <?= Html::textarea("support", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_support : "", ['maxlength' => true, 'class' => 'form-control']); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <?= Html::label('Tindakan') ?>
                    <ol>
                        <?php foreach ($model->rDoctorActions as $key => $value) : ?>
                            <li>
                                <small><?= $value->rda_name ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                    <?= Html::label('Pasien Kontrol', 'control-patient', ['class' => 'col-xs-12 no-padding-left']) ?>
                    <?= sprintf("%s Hari", !empty($model->rConsultations[0]) ? $model->rConsultations[0]->c_control_days : ""); ?>
                </div>
            </div>
        </div>
    </div>
</div>