<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Parameter */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Ubah Setting') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="parameter-update">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">            
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'zip_code')->textInput() ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'pin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'app_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">            
            <?= $form->field($model, 'footer')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
