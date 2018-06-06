<?php

defined('YXX_ROOT_PATH') or define('YXX_ROOT_PATH', dirname(dirname(__DIR__)));

if (false === getenv('YII_ENV')) {
    $dotenv = new Dotenv\Dotenv(YXX_ROOT_PATH);
    $dotenv->load();
}

defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') ?: true);
