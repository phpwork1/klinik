<?php
/**
 * Created by PhpStorm.
 * User: zehel09
 * Date: 9/16/2017
 * Time: 11:54 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ChosenAsset extends AssetBundle
{
    public $sourcePath = '@bower/chosen';
    public $css = [
        'chosen.css',
    ];
    public $js = [
        'chosen.jquery.js',
        'chosen.proto.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}