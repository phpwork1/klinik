<?php



/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchaseReturn */
/* @var $invoiceList frontend\models\GoodsPurchase[] */
/* @var $itemList frontend\models\GpDetail[] */

$this->title = 'Tambah Retur Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Retur Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- /.box-header -->
<?= $this->render('_form', [
    'model' => $model,
    'invoiceList' => $invoiceList,
    'itemList' => $itemList,
]) ?>
