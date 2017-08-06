<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Akun'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
$this->params['buttons'][] = Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
])
?>
<div class="account-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category.name:text:Kategori Akun',
            'code',
            'name',
            'beginning_balance:integer',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
