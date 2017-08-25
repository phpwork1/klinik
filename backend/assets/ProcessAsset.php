<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/8/2017
 * Time: 6:34 PM
 */

namespace backend\assets;
use yii\web\AssetBundle;

class ProcessAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/process.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}