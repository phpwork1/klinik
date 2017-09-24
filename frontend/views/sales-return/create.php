<?php



/* @var $this yii\web\View */
/* @var $model frontend\models\SalesReturn */
/* @var $invoiceList frontend\models\Sales[] */
/* @var $itemList frontend\models\SalesDetail[] */

$this->title = 'Tambah Retur Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Retur Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- /.box-header -->
<?= $this->render('_form', [
    'model' => $model,
    'invoiceList' => $invoiceList,
    'itemList' => $itemList,
]) ?>
