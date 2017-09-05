<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/9/2017
 * Time: 10:09 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class GoodsPurchaseIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/goods-purchase-index.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}