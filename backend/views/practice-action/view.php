<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PracticeAction */

$this->title = $model->pa_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practice Actions'), 'url' => ['index']];
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
        <h3 class="box-title"><?= Html::encode($model->id) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('pa_name') ?></th>
                <td><?= $model->pa_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('pa_cost') ?></th>
                <?php Yii::$app->formatter->locale = 'id-ID'; ?>
                <td><?= Yii::$app->formatter->asCurrency($model->pa_cost) ?></td>
            </tr>
            </table>
    </div>
</div>
