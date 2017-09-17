<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/16/2017
 * Time: 12:06 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SalesIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/sales-index.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}