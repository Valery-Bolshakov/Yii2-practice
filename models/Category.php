<?php


namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
//    Не забываем прописать настройки подключения к БД в config/db

//    Если вдруг изменится название таблицы в БД - пишем метод tableName() и указываем название таблицы:
    public static function tableName()
    {
        return 'category';
    }

}