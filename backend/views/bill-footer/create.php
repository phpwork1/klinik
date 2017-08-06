<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BillFooter */

$this->title = Yii::t('app', 'Tambah Bill Footer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill Footers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-footer-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
