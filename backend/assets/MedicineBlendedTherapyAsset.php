<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/8/2017
 * Time: 3:02 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class MedicineBlendedTherapyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/medicine_blended_therapy.js',
    ];
    public $depends = [
        'yii\web\JQueryAsset',
    ];
}