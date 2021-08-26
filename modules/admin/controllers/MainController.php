<?php


namespace app\modules\admin\controllers;


use app\modules\admin\models\Category;
use app\modules\admin\models\Order;
use app\modules\admin\models\Product;

class MainController extends AppAdminController
{
    /*Контроллер для Главной страницы Админской панели*/
    public function actionIndex()
    {
        /*Получаем в переменную $orders всю информацию из таблицы orders. Для этого обращаемся
        к модели Order (ВНИМАНИЕ!) пространства имен app\modules\admin\models\. Потому что
        запрашиваем данные из админки

        Получаем колличество заказов из модели Order посредством метода count()*/
        $orders = Order::find()->count();

        /*Получаем колличество продуктов из таблицы products:*/
        $products = Product::find()->count();

        /*Получаем колличество категорий из таблицы category:*/
        $categories = Category::find()->count();


        /*Передаем полученые значения в вид индекс*/
        return $this->render('index', compact('orders', 'products', 'categories'));
    }



}