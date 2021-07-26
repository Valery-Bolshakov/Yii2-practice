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

//    Устанавливаем связь между моделями Product и Category
    public function getCategory()
    {
//        Устанавливаем связсь где 'id' модели Category связываем с 'category_id' модели Product
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

}