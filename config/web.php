<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
//    Переназначаем деволтный маршрут на home/index
//    хелпер yii\helpers\Url:: и метод home() будут ссылаться на данный маршрут
    'defaultRoute' => 'home/index',
    // меняем язык
    'language' => 'ru',
    // меняем название сайта
    'name' => 'Yii2-practice',
    // меняем главный шаблон с layouts/main на layouts/grocery(это можно сделать в AppController)
    'layout' => 'grocery',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sHYa0Jpw5O6PEr3rQfLKE5vAqXfqSiOV',
//            Устанавливаем базовый url (избавляет от web в адресе при обращении к корню приложения)
            'baseUrl' => '',
        ],
//        Опция в которую передаются настройки кеширования
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,

//             массив правил для ссылок. Более конкретные правила должны стоять сверху общих правил.
            /** Адрес для ссылки задаем [В МАССИВЕ] - ::to(  ['адрес']  ), 'rules' иначе Нихуя не заработает.
             *  Пример: Url::to(['category/search']) */
            'rules' => [
//                '/' => 'site/index', - правило для домашней страницы
//                'hi|hello' => 'site/hello', - правило для доступности к странице по 2ум адресам

//                Настраиваем чпу для пагинации (из category/1?page=3 --> /category/1/page/3)
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',  //http://yii2-practice/category/1/page/3

                /* Уберем 'view' из адреса меню виджета:
                Указываем контроллер(CategoryController) category, затем указываем 'id:' как именованый
                параметр, и этому параметру должны соответствовать одна и более цифр '\d+' => для такого
                формата адреса устанавливаем соответствие пути 'category/view' контроллер/вид.

                И далее когда в файле components/menu_tpl/menu.php - отработает Url::to он обратится
                к данному правилу и построит нужный адрес ссылки http://yii2-practice/category/1 */
                'category/<id:\d+>' => 'category/view',

//                меняем вид ссылок для блока Hot Offers на http://yii2-practice/product/1
                'product/<id:\d+>' => 'product/view',

                /*Пишем настройки для адреса Поиска(Ранее он выгладел: yii2-practice/category/search?q=soup)
                Новому адресу search будет соответствовать контроллер category и экшен search*/
                'search' => 'category/search',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
