<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'Metal-holding',
    'name' => 'Metal-holding',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'defaultRoute' => '/site/index',
    'timeZone' => 'Europe/Kiev',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ],
        'presscenter' => [
            'class' => 'app\modules\presscenter\PressCenter',
        ],
        'offices' => [
            'class' => 'app\modules\offices\Offices',
        ],
        'gridview' => 'kartik\grid\Module',
    ],
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => $params['recaptchaSiteKey'],
            'secret' => $params['recaptchaSecretKey'],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => ['lifetime' => 3600*24*30],
            'timeout' => 3600*24*30,
            'useCookies' => true,
        ],
        'settingsConfig' => [
            'class' => 'app\components\SettingsImporter',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'aPq7FGvFJ9dkKGltT7eIw9L2Ni7q59jf',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'user'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //'mailer' => require(__DIR__ . '/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/admin' => 'admin.php',
                        'app/units' => 'units.php'
                    ],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd MMMM yyyy',
            'datetimeFormat' => 'd.MM.Y H:i:s',
            'timeFormat' => 'H:i:s',
            'defaultTimeZone' => 'Europe/Kiev', // time zone
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require (__DIR__ . '/urlManager.php'),
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
