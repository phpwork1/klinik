<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = $model->c_name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pelanggan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']);
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
        <h3 class="box-title"><?= Html::encode($model->id) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('c_name') ?></th>
                <td><?= $model->c_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('c_phone_number') ?></th>
                <td><?= $model->c_phone_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('c_address') ?></th>
                <td><?= $model->c_address ?></td>
            </tr>
            </table>
    </div>
</div>
