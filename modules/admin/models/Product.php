<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $content
 * @property float $price
 * @property float $old_price
 * @property string|null $description
 * @property string|null $keywords
 * @property string $img
 * @property int $is_offer
 */
class Product extends \yii\db\ActiveRecord
{
    public $file; // дописываем для этого свойства правила валидации

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /*Добавим связь с моделью категорий*/
    public function getCategory()
    {
        /*используем метод hasOne так как один товар может принадлежать одной категории*/
        return $this->hasOne(Category::class, ['id' => 'category_id']);
        /*Далее открываем генератор кода gii и реализуем операцию CRUD*/
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'is_offer'], 'integer'],
            [['content'], 'string'],
            [['price', 'old_price'], 'number'],
            [['title', 'description', 'keywords', 'img'], 'string', 'max' => 255],
//            [['file'], 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'ID категории',
            'title' => 'Наименование',
            'content' => 'Описание товара',
            'price' => 'Стоимость',
            'old_price' => 'Old Price',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'img' => 'Img',
            'file' => 'Фото',
            'is_offer' => 'Is Offer',
        ];
    }
}
