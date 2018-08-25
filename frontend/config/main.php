<?php

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrfToken',
            'enableCookieValidation' => false,
        ],
        'user' => [
            'identityClass' => 'App\Model\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'i', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'ss',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'enableRotation' => false,
                    'logVars' => [],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/twig/cache',
                    'options' => [
                    ],
                    'extensions' => [
                    ],
                    'globals' => [
                        'html' => ['class' => 'yii\helpers\Html'],
                    ],
                    'uses' => [
                        'yii\bootstrap',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [],
    // 访问控制
    'as guard' => [
        'class' => 'App\Filter\Guard',
    ],
];

// configuration adjustments for 'dev' environment
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];

    // Twig的开发环境设置
    $config['components']['view']['renderers']['twig']['options']['auto_reload'] = true; // 自动重新加载模板
    $config['components']['view']['renderers']['twig']['options']['debug'] = true; // 开启调试

    $config['components']['view']['renderers']['twig']['extensions'][] = 'Twig_Extension_Debug'; // 加载调试扩展
}

return $config;
