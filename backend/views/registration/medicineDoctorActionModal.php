<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21/8/2017
 * Time: 3:47 PM
 */

use yii\helpers\Html;
use common\components\helpers\AppConst;
use yii\helpers\Url;
use backend\assets\MedicineDoctorActionModalAsset;

MedicineDoctorActionModalAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\RDoctorAction */
/* @var $form yii\widgets\ActiveForm */
/* @var $registration_id int */
/* @var $position int */
$baseUrl = Url::base();
?>
<?php echo Html::hiddenInput('baseUrl', $baseUrl, ['id' => 'baseUrl']); ?>

<div class="container-fluid">
    <div class="row">
        <?php if ($position == 0) {

            echo $form->field($model, "rda_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->dropDownList(\backend\models\PracticeAction::map(), ['id' => 'doctorActionPracticeActionName', 'class' => 'input-big form-control', 'prompt' => '--Silahkan Pilih--'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
        } else {
            echo $form->field($model, "rda_name", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
                ->dropDownList(\backend\models\ClinicalAction::map(), ['id' => 'doctorActionClinicalActionName', 'class' => 'input-big form-control', 'prompt' => '--Silahkan Pilih--'])
                ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]);
        } ?>
        <?= $form->field($model, "rda_price", ['template' => AppConst::ACTIVE_FORM_TEMPLATE_DEFAULT])
            ->textInput(['id' => 'doctorActionPrice', 'maxlength' => true, 'class' => 'form-control text-right'])
            ->label(null, ['class' => AppConst::ACTIVE_FORM_CLASS_LABEL_COL_3]); ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="pull-right">
                <?= $form->field($model, "registration_id")
                    ->hiddenInput(['value' => $registration_id])->label(false) ?>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>

