<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php'),
    require(__DIR__ . '/container.php')
);

//require_once(__DIR__ . '/ts-stuff.php');
require_once(__DIR__ . '/../../common/components/helpers/debug.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ]
    ],
    'components' => [
//        'request'=>[
//            'class' => 'common\components\Request',
//            'web'=> '/backend/web',
//            'adminUrl' => '/admin'
//        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for backend
            ]
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Dy0a4ZKy6BdEiwB8V98y',
            'csrfParam' => '_backendCSRF',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'id_ID',
            'defaultTimeZone' => 'Asia/Jakarta',
            'dateFormat' => 'dd-MM-yyyy',
            'timeFormat' => 'php:H:i:s',
            'currencyCode' => 'IDR',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 2,
                NumberFormatter::MAX_FRACTION_DIGITS => 2
            ],
//            'decimalSeparator' => ',',
//            'thousandSeparator' => '.',
            'nullDisplay' => '-'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
    ],
    'params' => $params,
];
