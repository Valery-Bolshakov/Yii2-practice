<!--Так как левая часть контента тоже неизменна (меню продуктов)- создаем отдельный вид layouts/inc/sidebar
и вынесем её в отдельный вид подключаемый sidebar.
Открывающий тег <div class="banner"> переносим в шаблон grocery, вставляя перед $content-->

<div class="w3l_banner_nav_left">
    <nav class="navbar nav_bottom">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header nav_2">
            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                    data-target="#bs-megadropdown-tabs">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">

<!--            Вызываем виджет который создали ранее-->
            <?= \app\components\MenuWidget::widget([
                    /*Пишем массив настроек виджета
                    На месте сайдбара подключается файл menu.php (можно задать любой именованый вид для подключения)
                    Если ничего не подключать - то по умолчанию подключится файл menu.php из настроек в файле
                    MenuWidget*/
                    'tpl' => 'menu',  // menu.php
//                    Сюда можно передавать различные классы для построения различного вида виджетов для меню
                    'ul_class' => 'nav navbar-nav nav_1',  // css класс берем из html кода ниже
            ]) ?>

        </div><!-- /.navbar-collapse -->
    </nav>
</div>