<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body table-responsive person-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ..'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'minViewMode' => 0,
            'maxViewMode' => 1,
            'todayHighlight' => true,
        ]])
    ?>

    <?= $form->field($model, 'gender')->dropDownList(\common\components\helpers\AppConst::$GENDER) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marriage_status')->dropDownList(\common\components\helpers\AppConst::$MARRIAGE_STATUS) ?>

    <?= $form->field($model, 'educational_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dicipline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'majoring')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bbm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput()->label('Image Portrait') ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Kembali'), ['index'],[ 'class' => 'btn btn-danger']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
