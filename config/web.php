<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    /*Переназначаем деволтный маршрут на home/index. Теперь для главного шаблона
    приложения будет установлен контроллер по умолчанию HomeController с видом index
    хелпер yii\helpers\Url:: и метод home() будут ссылаться на данный маршрут*/
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
    /*Сгенерировали модуль админ с помозщю Gii и вставляем соотв настройку
    http://yii2-practice/gii - ссылка на модуль Gii в приложении*/
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            /*Устанавливаем главный шаблон для модуля Админ:
                по умолчанию yii его ищет в папке modules/admin/views/layouts*/
            'layout' => 'admin',
            /*Устанавливаем главный контроллер для админского шаблона: MainController
                и главный(дефолтный) вид для контроллера: index*/
            'defaultRoute' => 'main/index',
        ],
    ],
    'components' => [

        /*Для форматирования вывода Yii предоставляет класс, преобразующий данные в человеко-понятный формат.
        Настраиваем вывод даты заказа (admin/order/index) по нужному нам шаблону:*/
        'formatter' => [
            'datetimeFormat' => 'php:d M Y H:i:s',
        ],

        /*решаем проблемы с конфликтом библиотек при вводе формы:
        документация yii -> Ресурсы -> Настройка Комплектов Ресурсов*/
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать комплект
                    'js' => [
                        /* Вставляем сюда нашу библиотеку с которой происходил конфликт*/
                        'js/jquery-1.11.1.min.js',
                    ]
                ],
            ],
        ],
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
        /*Компонент user управляет статусом аутентификации пользователя.*/
        'user' => [
            'identityClass' => 'app\models\User',
            /*Настройка нужна что бы юзер автоматически залогинивался если сайт запомнил его*/
            'enableAutoLogin' => true,
            /*задаем маршрут для аутентификации пользователей*/
            'loginUrl' => '/admin/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*Данный компонет отвечает за настройки возможности отправки почты*/
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

             /*  Данная настройка предназначена для тестирования отправки почты(ТЕСТИРОВАНИЯ!
             в реале пока настройка в true почта не отправляется. а сохраняется в текстовый
             файл в runtime/mail).
                Для отправки почты данную настройку надо переводить в false а так же
             загуглить настройки по запросу "yii2 swiftmailer smtp".
                Документацию по отправке почты через почтовые сервисы можно найти по
             запросу например "gmail smtp"*/
            'useFileTransport' => false,

            /*Загуглили настройки Yii2 mailer и устанавливаем 'useFileTransport' => false
            Устанавливаю настройки для сервиса mail.ru   (smtp mail.ru)*/
            'transport' => [
                'class' => 'Swift_SmtpTransport',  // оставляем как в настройках
                'host' => 'smtp.mail.ru',  // Указываем smtp сервис который используем
                /*Почта и пароль должны совпадать с реальной учеткой почты */
                'username' => 'Email@email.com',  // Должно соответствовать senderEmail из config/params
                'password' => 'password',  // пароль от почты
                /*port и encryption надо смотреть в докум smtp сервиса который используем*/
                'port' => '465',  // В некоторых сервисах 2525
                'encryption' => 'ssl',  // либо tls
            ],
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

    /*
     * ElFinder Расширение для Yii 2
    ElFinder — файловый менеджер для сайта.
    Вставляем настройки для данного расширения, которое способствует загрузке картинок
    (github.com/MihailDev/yii2-elfinder)
    */
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],  // настройка ограничение доступа для авторихованных пользователей
            'root' => [
                /*настройка для указания куда загружать файлы (создаем папку web/upload)*/
                'path' => 'upload/files',
                'name' => 'Files'
            ],
        ]
    ],


    'params' => $params,
];
/*  Настройки для модуля Gii. Данный модуль по умолчанию доступен только в режиме
разработки и только на локальном хосте. Если хотим работать на реальном - надо установить
настройку allowedIPs
    YII_ENV_DEV - данная константа отвечает за доступность режима разработки*/
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
        /*Данная настройка позволяет получить доступ к модулю Gii при работе на
        реальном хосте*/
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
