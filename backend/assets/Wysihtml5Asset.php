<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

class Wysihtml5Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5';

    public $css = [
        'bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        'bootstrap3-wysihtml5.all.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dmstr\web\AdminLteAsset',
    ];

//    /**
//     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
//     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
//     */
//    public $skin = '_all-skins';
//
//    /**
//     * @inheritdoc
//     */
//    public function init()
//    {
//        // Append skin color file if specified
//        if ($this->skin) {
//            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
//                throw new Exception('Invalid skin specified');
//            }
//
//            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
//        }
//
//        parent::init();
//    }
}
