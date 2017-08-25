<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/8/2017
 * Time: 6:40 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class ProcessMedicineAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/process-medicine.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}