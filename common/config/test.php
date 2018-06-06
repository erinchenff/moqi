<?php

$config = [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.getenv('DB_TEST_HOST').';dbname='.getenv('DB_TEST_DATABASE'),
            'username' => getenv('DB_TEST_USERNAME'),
            'password' => getenv('DB_TEST_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
];

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__.'/main.php',
    $config
);

return $config;
