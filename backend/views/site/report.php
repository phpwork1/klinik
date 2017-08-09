<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-sm-2">
        <legend>Produk</legend>
        <p><?= Html::a('Produk', ['/product/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Mutasi Produk', ['/product-history/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Produk Perlu Restok', ['/product/report', 'ProductSearch[restock]' => 1], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Best Seller', ['/sale-order-detail/best-seller'], ['class' => 'text-info']) ?></p>
        <legend>Rangkuman</legend>
        <p><?= Html::a('Rangkuman', ['/report/summary'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Laporan harian', ['/report/daily'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Laporan bulanan', ['/report/monthly'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Laporan tahunan', ['/report/annualy'], ['class' => 'text-info']) ?></p>
    </div>
    <div class="col-sm-2">
        <legend>Pengeluaran</legend>
        <p><?= Html::a('Pembelian', ['/purchase-order/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Rincian Pembelian', ['/purchase-order-detail/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Pelunasan Pembelian', ['/purchase-payment/report'], ['class' => 'text-info']) ?></p>
        <!--<p><?php Html::a('Tanda Terima Pembelian', ['/purchase-receipt/report'], ['class' => 'text-info']) ?></p>-->
        <p><?= Html::a('Retur Pembelian', ['/purchase-return/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Rincian Retur Pembelian', ['/purchase-return-detail/report'], ['class' => 'text-info']) ?></p>
        <hr>
        <p><?= Html::a('Pengeluaran', ['/expense/report'], ['class' => 'text-info']) ?></p>
    </div>
    <div class="col-sm-2">
        <legend>Pendapatan</legend>
        <!--<p><?= Html::a('Penjualan Tunai Harian', ['/cash-sale/report'], ['class' => 'text-info']) ?></p>-->
        <p><?= Html::a('Penjualan', ['/sale-order/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Rincian Penjualan', ['/sale-order-detail/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Pelunasan Penjualan', ['/sale-payment/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Tanda Terima Penjualan', ['/sale-receipt/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Retur Penjualan', ['/sale-return/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Rincian Retur Penjualan', ['/sale-return-detail/report'], ['class' => 'text-info']) ?></p>
        <hr>
        <p><?= Html::a('Pendapatan lain-lain', ['/income/report'], ['class' => 'text-info']) ?></p>
        <!--<p><?= Html::a('Pendapatan Kotor', ['/income/report'], ['class' => 'text-info']) ?></p>-->
    </div>
    <div class="col-sm-2">
        <legend>Partner</legend>
        <p><?= Html::a('Supplier', ['/supplier/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Pelanggan', ['/customer/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Karyawan', ['/employee/report'], ['class' => 'text-info']) ?></p>
        <hr>
        <p><?= Html::a('Term of Payment', ['/term-of-payment/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Kota', ['/City/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Provinsi', ['/province/report'], ['class' => 'text-info']) ?></p>
    </div>
    <div class="col-sm-2">
        <legend>Akun</legend>
        <!--<p><?= Html::a('Ledger', ['/account/ledger'], ['class' => 'text-info']) ?></p>-->
        <p><?= Html::a('Akun', ['/account/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Kategori Akun', ['/account-category/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('Grup Akun', ['/account-group/report'], ['class' => 'text-info']) ?></p>
        <legend>Setting</legend>
        <p><?= Html::a('Printer', ['/printer/report'], ['class' => 'text-info']) ?></p>
        <p><?= Html::a('User', ['/user/report'], ['class' => 'text-info']) ?></p>
    </div>
</div>