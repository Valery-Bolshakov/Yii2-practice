<?php
/*СТРАНИЦА ВИДА  Список заказов*/
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row"><!--обернем таблицу в класс row-->
    <div class="col-md-12"><!--Задаем ширину таблицы на всю страницу-->
        <!--https://adminlte.io/themes/AdminLTE/pages/tables/simple.html
        Копируем готовую разметку для таблицы с сайта шаблона админки-->

        <div class="box">
            <div class="box-header with-border">
                <!--a("название кнопки", ["экшен"], ['class'])-->
                <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <!--удаляем разметку таблицы и вставляем сюда код со своими данными-->
                <div class="order-index">

                    <!--На главной странице admin/order/index для отображения списка заказов использовали данный
                    виджет. Подробнее про него можно почитать Yii2/Отображение данных/Виджеты для данных-->
                    <?= GridView::widget([
                        /*Таблица данных или GridView - это один из сверхмощных Yii виджетов.*/
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            /*класс для колонок таблицы*/
//                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            /*Настраиваем вывод даты заказа: 13 Aug 2021 01:35:09*/
//                            'created_at',
                            [
                                'attribute' => 'created_at',
                                'format' => 'datetime',  // Общий вариант  (24 Aug 2021 01:50:46)
//                                'format' => ['datetime', 'php:d M Y H:i:s']  // Частный случай
                            ],
                            /*[
                                'attribute' => 'created_at',
                                'format' => 'date',  // Формат даты по умолчанию (Aug 24, 2021)
                            ],*/

                            'updated_at',
                            'qty',
                            'total',
                            /*По умолчанию статус заказа выводит либо 0 либо 1, Переделаем его в понятный вид:*/
//                            'status',
                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                /*Возвращаем статус и условие "Если статус вернет 1(true) "?" то вернем одно
                                значение, В противном случае ":" возвращаем другое значение":*/
                                    return $data->status ? '<span class="text-green">Завершён</span>' :
                                        '<span class="text-yellow">Новый</span>';
                                },
                                /*для того что бы html адекватно читался устанавливаем настройку
                                format как сырую строку raw*/
                                'format' => 'raw',
                            ],
                            //'name',
                            /* ...":email" - отвечает за то что емейл будет работать как ссылка.
                            За это отвечает специальный класс formatter, ознакомиться можно в разделе
                            форматирование данных*/
                            //'email:email',
                            //'phone',
                            //'address',
                            //'note:ntext',

                            /*класс для колонок действий (просмотр, удаление, редактирование)*/
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Действия'
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


