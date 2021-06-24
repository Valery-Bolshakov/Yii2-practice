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

}