<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
//    require __DIR__ . '/params.php',
//    require __DIR__ . '/params-local.php'
);
return [
    'id' => 'app-account',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'controllerNamespace' => 'account\controllers',
    'components' => [
//        'assetManager' => [
//            'bundles' => [
//                'kartik\form\ActiveFormAsset' => [
//                    'bsDependencyEnabled' => false, // do not load bootstrap assets for a specific asset bundle
//                    'bsVersion' => '5.x',
//                ],
//            ],
//        ],
        'request' => [
            'csrfParam' => '_csrf-account',
            'cookieValidationKey' => 'your-secret-key',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-account', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-account',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];