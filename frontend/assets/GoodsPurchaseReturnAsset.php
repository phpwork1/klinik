<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/18/2017
 * Time: 7:04 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class GoodsPurchaseReturnAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/goods-purchase-return.js',
        'js/stringbuilder.js',
        'js/accounting.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}