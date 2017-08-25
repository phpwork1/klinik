<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18/8/2017
 * Time: 5:00 PM
 */

namespace backend\assets;
use yii\web\AssetBundle;

class MedicineTherapyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/medicine_therapy.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}