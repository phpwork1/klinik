<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/9/2017
 * Time: 1:54 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SalesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/sales.js',
        'js/stringbuilder.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}