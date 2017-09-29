<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

?>
<div class="box box-info">
    <table id="table-patient-detail" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>No. Reg</th>
            <th>Tanggal</th>
            <th>Berat (Kg)</th>
            <th>Tensi</th>
            <th>Suhu</th>
            <th>Keluhan</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->registrations as $key => $value): ?>
            <tr>
                <td><?= $value->r_number ?></td>
                <td><?= $value->r_date ?></td>
                <td><?= $value->r_patient_weight ?></td>
                <td><?= $value->r_patient_tension ?></td>
                <td><?= $value->r_patient_temp ?></td>
                <td><?= $value->r_complaint ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
