<?php
require_once "ReleaseType.php";
// comment out the following two lines when deployed to production
//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');

defined('RELEASE_TYPE') or define('RELEASE_TYPE', ReleaseType::STABLE);
defined('APP_VER') or define('APP_VER', '4.0.0');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
