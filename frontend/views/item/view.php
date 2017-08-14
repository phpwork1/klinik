<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Item */

$this->title = $model->i_name;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
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
Yii::$app->formatter->locale = 'id-ID';
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($model->id) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('item_category_id') ?></th>
                <td><?= $model->itemCategory->getItemCategoryName($model->item_category_id) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_name') ?></th>
                <td><?= $model->i_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_description') ?></th>
                <td><?= $model->i_description ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_factory') ?></th>
                <td><?= $model->i_factory ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_buy_price') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_buy_price)?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_sell_price') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_sell_price) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_ppn') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_ppn) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_retail_price') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_retail_price) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_net_price') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_net_price) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_blend_price') ?></th>
                <td><?= Yii::$app->formatter->asCurrency($model->i_blend_price) ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_stock_amount') ?></th>
                <td><?= $model->i_stock_amount ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_unit') ?></th>
                <td><?= $model->i_unit ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_stock_min') ?></th>
                <td><?= $model->i_stock_min ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_stock_max') ?></th>
                <td><?= $model->i_stock_max ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('i_expired_date') ?></th>
                <td><?= Yii::$app->formatter->asDate($model->i_expired_date,'long') ?></td>
            </tr>
            </table>
    </div>
</div>
