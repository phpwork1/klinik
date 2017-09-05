<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/9/2017
 * Time: 10:40 AM
 */

namespace frontend\assets;
use yii\web\AssetBundle;

class GoodsPurchaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/goods-purchase.js',
        'js/stringbuilder.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}