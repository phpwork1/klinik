<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RoleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-group">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <p class="alert alert-danger">Yakin ingin menghapus semua transaksi? Setidaknya back-up terlebih dahulu data-data sebelum di menekan tombol 'hapus'</p>

    <?= Html::submitButton(Yii::t('app', 'Hapus'), ['class' => 'btn btn-danger', 'data-confirm' => 'Yakin ingin menghapus data? Semua data yang tersimpan sampai saat ini akan hilang. Bila yakin, tekan OK']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
