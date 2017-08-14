<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ItemCategory */

$this->title = $model->ic_name;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Barang', 'url' => ['index']];
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
                <th><?= $model->getAttributeLabel('ic_name') ?></th>
                <td><?= $model->ic_name ?></td>
            </tr>
            </table>
    </div>
</div>
