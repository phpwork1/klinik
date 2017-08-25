<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/8/2017
 * Time: 2:27 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class ProcessSearchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/process-search.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}