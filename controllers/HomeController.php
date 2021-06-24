<?php


namespace app\controllers;


use app\models\Product;

class HomeController extends AppController
{
    public function actionIndex()
    {
//        получаем первые 4 товары которые лежат в таблице product, для их дальнейшего использования
        $offers = Product::find()->where(['is_offer' =>1])->limit(4)->all();
//        посмотрим получили ли указанные товары:
//        debug($offers);
//        Переходим в файл home/index и работаем с блоком Hot Offers

//        Далее передаем полученые товары в вид: compact('offers')
        return$this->render('index', compact('offers'));
    }

}