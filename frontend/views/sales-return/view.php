<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesReturn */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => 'Are you sure you want to delete this item?',
'method' => 'post',
],
]);
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('id') ?></th>
                <td><?= $model->id ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('sales_id') ?></th>
                <td><?= $model->sales_id ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('sr_return_number') ?></th>
                <td><?= $model->sr_return_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('sr_date') ?></th>
                <td><?= $model->sr_date ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('sr_total_return') ?></th>
                <td><?= $model->sr_total_return ?></td>
            </tr>
            </table>
    </div>
</div>
