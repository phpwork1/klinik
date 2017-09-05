<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/8/2017
 * Time: 4:50 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class medicineDetailModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/action-view/medicine_detail_modal.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}