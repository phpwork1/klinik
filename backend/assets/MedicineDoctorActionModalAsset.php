<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21/8/2017
 * Time: 10:57 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class MedicineDoctorActionModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/medicine_doctor_action_modal.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}