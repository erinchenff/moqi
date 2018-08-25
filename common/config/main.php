<?php

return [
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)).'/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
    'container' => [
        'singletons' => [
            // Conduit的Client
            'conduitClient' => function () {
                return new \Lhjx\Phabot\Conduit\Client(
                    getenv('PHAB_CONDUIT_URI'),
                    getenv('PHAB_CONDUIT_TOKEN')
                );
            },
        ],
    ],
];
