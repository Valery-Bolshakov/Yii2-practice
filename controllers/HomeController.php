<?php


namespace app\controllers;


use app\models\Product;

class HomeController extends AppController
{
//    Создали контроллер который будет работать с главной страницей приложения

    public function actionIndex()
    {
//        Обращаемся к модели Product и получаем в $offers первые 4 товарa(->limit(4)) которые лежат в таблице
//        product, для их дальнейшего использования
        $offers = Product::find()->where(['is_offer' => 1])->limit(4)->all();
//        посмотрим получили ли указанные товары:
//        debug($offers);
//        Переходим в файл home/index и работаем с блоком Hot Offers

//        Далее передаем полученые товары в вид: compact('offers')
        return $this->render('index', compact('offers'));
    }

}