<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model frontend\models\Sales */
/* @var $type int */

$totalPrice = 0;
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
                        <th width="30%" class="text-center">
                            Nama Barang
                        </th>
                        <th width="15%" class="text-center">
                            Harga
                        </th>
                        <th width="15%" class="text-center">
                            Jumlah
                        </th>
                        <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                            <th width="7%" class="text-center">
                                Disk(%)
                            </th>
                        <?php } ?>
                        <th width="20%" class="text-center">
                            Total
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->salesDetails as $keyD => $detail): ?>
                        <?php $totalBlendPrice = 0; ?>
                        <tr>
                            <td class="text-center"><?= ($keyD + 1) ?></td>
                            <td>
                                <?= $detail->item->i_name ?>
                                <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_INTERNAL) : ?>
                                    <ul>
                                        <?php foreach ($detail->salesDetailInternals[0]->rMedicine->rmDetails as $keyR => $rmDetail) : ?>
                                            <?php $totalBlendPrice += $rmDetail->rmd_amount * $rmDetail->item->i_blend_price; ?>
                                            <li>
                                                <?= sprintf("%s >> %s x Rp. %s = Rp. %s", $rmDetail->item->i_name, $rmDetail->rmd_amount, number_format($rmDetail->item->i_blend_price,0,'.', ','), number_format($rmDetail->rmd_amount * $rmDetail->item->i_blend_price,0,'.',',')); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                            <?php if ($type == \frontend\controllers\SalesController::SALES_TYPE_EXTERNAL) { ?>
                                <td class="text-center"><?= sprintf("Rp. %s", number_format($detail->item->i_sell_price, 0, '.', ',')); ?></td>
                                <td class="text-center"><?= $detail->sd_quantity ?></td>
                                <td class="text-center"><?= $detail->sd_discount ?></td>
                                <td class="text-center">
                                    <?= sprintf("Rp. %s", number_format($detail->item->i_sell_price * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)),0, '.', ',')); ?>
                                    <?php $totalPrice += $detail->item->i_sell_price * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)); ?>
                                </td>
                            <?php } else { ?>
                                <td class="text-center"><?= sprintf("Rp. %s", number_format($totalBlendPrice,0, '.', ',')); ?></td>
                                <td class="text-center"><?= $detail->sd_quantity ?></td>
                                <td class="text-center">
                                    <?= sprintf("Rp. %s", number_format($totalBlendPrice * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)),0, '.', ',')); ?>
                                    <?php $totalPrice += $totalBlendPrice * $detail->sd_quantity * (1 - ($detail->sd_discount / 100)); ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="pull-right">
                    <?= Html::label("Total Harga", 'total'); ?>
                    <?= Html::textInput("total", "Rp. " . number_format($totalPrice,0,'.', ','), ['class' => 'no-padding-left form-control text-right', 'readOnly' => true]) ?>
                    <?= Html::label("Total Dibayar", 'paid'); ?>
                    <?= Html::textInput("paid", "Rp. " . number_format($model->s_total_paid,0,'.',','), ['class' => 'no-padding-left form-control text-right', 'data-cell' => 'Y1', 'readOnly' => true]) ?>
                    <?= Html::label("Kembalian", 'change'); ?>
                    <?= Html::textInput("change", "Rp. " . number_format($model->s_total_paid-$totalPrice,0,'.', ','), ['class' => 'no-padding-left form-control text-right', 'readOnly' => true]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
