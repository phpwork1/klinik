<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/8/2017
 * Time: 1:28 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class MedicineDoctorActionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/medicine_doctor_action.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}