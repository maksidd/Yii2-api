<?php

// Set correct paths
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

// Include Composer autoloader
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

// Load configuration
$config = require __DIR__ . '/../../config/web.php';

// Initialize application
new \yii\web\Application($config);