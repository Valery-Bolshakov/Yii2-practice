<?php
/*ФРОНТКОНТРОЛЛЕР ВСЕГО ПРИЛОЖЕНИЯ*/

// ЗАКОММЕНТИРУЙТЕ следующие две строки при переносе приложения на реальный сервер
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

//Подключаем файл для дебага
require __DIR__ . '/../libs/funcs.php';

(new yii\web\Application($config))->run();
