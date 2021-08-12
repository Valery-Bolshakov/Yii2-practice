<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Order extends ActiveRecord
{
    /** Модель для взаимодействия с формой карзины */

    public static function tableName()
    {
        return 'orders';
    }

    /*TimestampBehavior — ПОВЕДЕНИЕ, которое позволяет автоматически обновлять атрибуты с
    метками времени при сохранении Active Record моделей через insert(), update() или save().*/
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /*Пропишем некоторые правила валидации для формы*/
    public function rules()
    {
        /*методом rules возвращаем массив правил валидации для формы корзины*/
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            ['note', 'string'],
            ['email', 'email'],
            [['created_at', 'updated_at'], 'safe'],
            ['qty', 'integer'],  // валидатор integer проверяет на Целочисленное число
            ['total', 'number'],  // валидатор number проверяет число ли это
            ['status', 'boolean'],
        ];
    }
    /*Сменим названия полей формы на нужные нам*/
    public function attributeLabels()
    {
        return [
            'name' => 'Имя:',
            'email' =>'E-mail:',
            'phone' => 'Телефон:',
            'address' => 'Адрес:',
            'note' => 'Примечание:',
        ];
    }

}