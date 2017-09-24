<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/22/2017
 * Time: 9:33 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SalesReturnAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/sales-return.js',
        'js/stringbuilder.js',
        'js/accounting.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}