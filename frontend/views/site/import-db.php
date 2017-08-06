<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RoleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-group">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'sqldump')->fileInput() ?>

    <?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn btn-primary', 'data-confirm' => 'Yakin ingin menimpa data? Sangat beresiko dan ada kemungkinan gagal yang mengakibatkan program tidak dapat dipakai.']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
