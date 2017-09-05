<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\GoodsPurchase */

?>
<div class="box box-primary">
    <div class="box-body table-responsive">
        <div class="container-fluid">
            <div class="row">
                <table id="table-item" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="3%" class="text-center">
                            No
                        </th>
                        <th width="40%" class="text-center">
                            Nama Barang
                        </th>
                        <th class="text-center">
                            Harga
                        </th>
                        <th width="7%" class="text-center">
                            Jumlah
                        </th>
                        <th width="15%" class="text-center">
                            Total
                        </th>
                        <th width="15%" class="text-center">
                            Tgl Expire
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->gpDetails as $keyD => $detail): ?>
                        <tr>
                            <td class="text-center"><?= ($keyD + 1) ?></td>
                            <td class="text-center"><?= $detail->item->i_name ?></td>
                            <td class="text-center"><?= sprintf("Rp. %s",$detail->gpd_price); ?></td>
                            <td class="text-center"><?= $detail->gpd_quantity ?></td>
                            <td class="text-center">
                                <?= sprintf("Rp. %s",$detail->gpd_price*$detail->gpd_quantity); ?>
                                <?= Html::hiddenInput("totalPrice",  $detail->gpd_price*$detail->gpd_quantity, ['data-cell' => "A$keyD"]); ?>
                            </td>
                            <td class="text-center"><?= $detail->gpd_expire_date ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
