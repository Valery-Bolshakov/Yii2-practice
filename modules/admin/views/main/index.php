<?php
/* Главный вид Админской панели. Здесь будет показана Статистика магазина*/

/*Воспользуемся стандартным Виджетом фреймворка Yii2 для Хлебных крошек:
Тайтлы будем писать прямо в видах*/
$this->title = 'Статистика магазина';
$this->params['breadcrumbs'][] = $this->title;

?>
<!--Далее надо вывести полученные из контроллера статистические данные. Что бы обернуть
их в нужный html код можно скопировать его из шаблона админки приложения
https://adminlte.io/themes/AdminLTE/pages/widgets.html
Находим нужный код и Copy->copy element. Создаем как в шаблоне класс row и вставляем
в него скопированый блок кода-->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <!--колличество заказов-->
                <h3><?= $orders ?></h3>
                <p>Заказов</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <!--ссылка будет вести на просмотр всех заказов:
            Далее воспользуемся генератором кода GII для формирования контроллера и представлений,
            где будут отображаться данные по ссылкам-->
            <a href="<?= \yii\helpers\Url::to(['order/index']) ?>" class="small-box-footer">
                Список заказов <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <!--Колличество категорий товаров-->
                <h3><?= $categories ?></h3>
                <p>Категорий товаров</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['category/index']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <!--Колличество Товаров:-->
                <h3><?= $products ?></h3>
                <p>Товаров</p>
            </div>
            <!--Кастомизировал иконки, образцы взял из раздела adminlte-elements-icons
            https://adminlte.io/themes/AdminLTE/pages/UI/icons.html-->
            <div class="icon">
                <i class="fa fa-cutlery"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['product/index']) ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>
