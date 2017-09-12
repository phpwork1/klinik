<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Item[] */
?>

<div class="box box-primary">
    <div class="box-body goods-purchase-form">
        <div class="container-fluid">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th rowspan="2" class="text-center">
                        Kode
                    </th>
                    <th rowspan="2" class="text-center">
                        Nama Barang
                    </th>
                    <th rowspan="2" class="text-center">
                        Deskripsi
                    </th>
                    <th rowspan="2" class="text-center">
                        Pabrik
                    </th>
                    <th rowspan="2" class="text-center">
                        Satuan
                    </th>
                    <th rowspan="2" class="text-center">
                        Stock
                    </th>
                    <th rowspan="1" colspan="2" class="text-center">
                        Harga
                    </th>
                    <th rowspan="2" class="text-center">
                        Kategori
                    </th>
                </tr>
                <tr>
                    <th rowspan="1" class="text-center">
                        Jual
                    </th>
                    <th rowspan="1" class="text-center">
                        HJR
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $key => $value): ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->i_name ?></td>
                        <td><?= $value->i_description ?></td>
                        <td><?= $value->i_factory ?></td>
                        <td><?= $value->i_unit ?></td>
                        <td><?= $value->i_stock_amount ?></td>
                        <td><?= $value->i_sell_price ?></td>
                        <td><?= $value->i_blend_price ?></td>
                        <td><?= $value->itemCategory->ic_name ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
