<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Province */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('id') ?></th>
                <td><?= $model->id ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('name') ?></th>
                <td><?= $model->name ?></td>
            </tr>
            </table>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Regencies / Kabupaten
    </div>
    <div class="panel-body no-padding">
        <?php
        $provider = new \yii\data\ArrayDataProvider([
            'allModels' => $model->regencies
        ]);

        echo $this->render('/regency/report', ['dataProvider' => $provider, 'searchModel' => false]);
        ?>
    </div>
</div>
