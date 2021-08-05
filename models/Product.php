<?php


namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
//    Укажем название таблицы на всякий случай
    public static function tableName()
    {
        return 'product';
    }

    /** Устанавливаем связь между моделями Product и Category */
    public function getCategory()
    {
        /*Устанавливаем связь параметра 'id' модели Category связываем с параметром 'category_id' модели Product
        Теперь можно доставать свойства таблицы category: $product->category->title*/
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

}