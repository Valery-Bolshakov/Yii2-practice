<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord
{
    /** Создали модель для правил валидации уже оформленных заказов */

    public static function tableName()
    {
        return 'order_product';
    }

    /*Пишем массив правил валидации*/
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'price', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /*Пишем метод для сохранения заказа корзины в соответствующей таблице*/
    public function saveOrderProducts($products, $order_id)
    {
        foreach ($products as $id => $product) {
            /*Обнуляем id что бы не приходило 2 одинаковых товара:*/
            $this->id = null;
            /*Так ка на каждой итерации надо работать с новой записью - обращаемся к
            ActiveRecord свойству isNewRecord и выставляем его в true. Таким образом будем сохранять каждый
            продукт а не перезаписывать его*/
            $this->isNewRecord = true;
            /*заполняем таблицу значениями из заказа*/
            $this->order_id = $order_id;
            $this->product_id = $id;
            $this->title = $product['title'];
            $this->price = $product['price'];
            $this->qty = $product['qty'];
            $this->total = $product['qty'] * $product['price'];
            /*если метод save вернет false тогда мы тоже возвращаем false*/
            if (!$this->save()) {
                return false;
            }
        }
        return true;
    }

}