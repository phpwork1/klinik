<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/29/2017
 * Time: 10:26 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class PatientIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/patient-index.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}