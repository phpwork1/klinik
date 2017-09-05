<?php



/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchase */
/* @var $gpDetailModel frontend\models\GpDetail */
/* @var $addItemModel frontend\models\Item */
/* @var $addSupplierModel frontend\models\Supplier */

$this->title = 'Tambah Transaksi Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Transaksi Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- /.box-header -->
<?= $this->render('_form', [
    'model' => $model,
    'gpDetailModel' => $gpDetailModel,
    'addItemModel' => $addItemModel,
    'addSupplierModel' => $addSupplierModel,
]) ?>
