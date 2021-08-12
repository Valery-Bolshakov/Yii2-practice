<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/bootstrap.css',
        'css/style.css',
        'css/font-awesome.css',
        '//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic',
        '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic',
        'css/flexslider.css',
        '',
    ];

    public $js = [
//        Приоритет подключения примерно такой - jquery - bootstrap - остальные скрипты - созданые нами скрипты

        /*при внедрении формы оформления заказа Yii дополнительно подключает библиотеку jquery-3.5,
            Это создает конфликт с нашей библиотекой jquery-1.11. Для того что бы решить данный конфликт
            закоментим jquery-1.11, заходим в документацию yii -> Ресурсы -> Настройка Комплектов Ресурсов
            И далее копируем код массива assetManager. Затем переходим в config/web и вставляем данные
            настройки в компонент components => [..., 'js/jquery-1.11.1.min.js', ... ] Не забывая
            указать нашу библиотеку jquery */
//        'js/jquery-1.11.1.min.js',
        'js/bootstrap.min.js',
        'js/move-top.js',
        'js/easing.js',
        'js/jquery.flexslider.js',

//        Удобнее использовать модальные окна бутстрапа для корзины, но пока что оставляем стандартный вариант:
        'js/minicart.js',

        /*Подключаем скрипт окзум, который реализует лупу в карточке товара, и копируем скрипт обращения к
           окзуму, помещая его в файл main.js*/
        'js/okzoom.js',

        /*При наличии в шаблоне приложения вкраплений js скриптов - создаем для них отдельный файл(main.js) в
        дирректории web/js, переносим js скрипты в него и затем подлючаем его как обычный js файл*/
        'js/main.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset', // Так как скрипты и стили подключаем из готового
// шаблона магазина - убираем подключение бутстрапа в Yii шаблоне
    ];
}

