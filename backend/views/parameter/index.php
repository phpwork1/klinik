<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Parameter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
?>
<div class="parameter-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'address',
            'city',
            'province',
            'zip_code',
            'phone',
            'mobile',
            'pin',
            'facebook',
            'twitter',
            'logo',
            'slogan',
            'app_name',
            'header',
            'footer',
            [
                'attribute' => 'invoice_printer',
                'value' => $model->invoicePrinter->computer_name . ' / ' . $model->invoicePrinter->printer_name,
            ],
            [
                'attribute' => 'receipt_printer',
                'value' => $model->receiptPrinter->computer_name . ' / ' . $model->receiptPrinter->printer_name,
            ],
        ],
    ]) ?>

</div>
