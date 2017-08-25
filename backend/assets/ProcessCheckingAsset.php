<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/8/2017
 * Time: 11:18 AM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class ProcessCheckingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/process-checking.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}