<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = $model->p_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pasien'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
'method' => 'post',
],
]);
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($model->p_medical_number) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('religion_id') ?></th>
                <td><?= $model->religion->getReligionName($model->religion_id) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('job_id') ?></th>
                <td><?= $model->job->getJobName($model->job_id) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('patient_id') ?></th>
                <td><?= is_null($model->patient_id) ? "" : $model->patient->p_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_medical_number') ?></th>
                <td><?= $model->p_medical_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_registration_date') ?></th>
                <td><?= $model->p_registration_date ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_name') ?></th>
                <td><?= $model->p_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_pob') ?></th>
                <td><?= $model->p_pob ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_dob') ?></th>
                <td><?= $model->p_dob ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_gender') ?></th>
                <td><?= $model->getGenderType() ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_address') ?></th>
                <td><?= $model->p_address ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_postal_code') ?></th>
                <td><?= $model->p_postal_code ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_contact_number') ?></th>
                <td><?= $model->p_contact_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('p_ref') ?></th>
                <td><?= $model->p_ref ?></td>
            </tr>
            </table>
    </div>
</div>
