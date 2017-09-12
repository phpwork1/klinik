<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
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
                <th><?= $model->getAttributeLabel('s_invoice_number') ?></th>
                <td><?= $model->s_invoice_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('s_date') ?></th>
                <td><?= $model->s_date ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('s_cashier') ?></th>
                <td><?= $model->s_cashier ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('s_total_paid') ?></th>
                <td><?= $model->s_total_paid ?></td>
            </tr>
            </table>
    </div>
</div>
