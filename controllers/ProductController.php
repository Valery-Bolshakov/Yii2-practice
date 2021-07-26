<?php


namespace app\controllers;


use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
//    Создали экшен для странички карточки товаров
    public function actionView($id)
    {
//        Параметром данный экшен будет принимать id запрашиваемого товара
//        Обращаемся к модели Product и получаем продукт, записывая его в переменную $product:
        $product = Product::findOne($id);

//        Если данного продукта нет - выбрасываем исключение:
        if (empty($product)) {
            throw new NotFoundHttpException('Такого продукта нет!');
        }

//        Установим тайтл страницы
        $this->setMeta("{$product->title} :: " . \Yii::$app->name, $product->keywords, $product->description);

        return $this->render('view', compact('product'));
    }

}