<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Sales */
/* @var $registrationModel backend\models\Registration */
/* @var $allItem frontend\models\Item[] */
/* @var $itemList [] */
/* @var %type string */

$this->title = 'Tambah Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- /.box-header -->
<?= $this->render('_form', [
    'allItem' => $allItem,
    'itemList' => $itemList,
    'model' => $model,
    'registrationModel' => $registrationModel,
    'type' => $type,
]) ?>
