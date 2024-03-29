<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

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
    /*так как в форме мы ввели новый атрибут 'file' то вносим в модель соотв свойство*/
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
            /*добавляем валидатор default со значением по умолчанию 'value' => 0 что бы избежать
            ошибок когда добавляют новый товар и не указывают старую цену */
            [['price', 'old_price'], 'default', 'value' => 0],
            /*добавим для свойства img дефолтное значение*/
            [['img'], 'default', 'value' => 'products/no-image.png'],
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

    /*Напишем метод который будет отрабатывать перед сохранением нового товара*/
    public function beforeSave($insert)
    {
        /*в переменню файл мы должны получить обьект в котором будет информация о загруженном файле
        Первым пораметром обьекта передаем модель, так как мы передаем нашу текущую модель то
        просто первым параметром пишем $this
        Вторым параметром передаем название атрибута этой модели с которым мы работаем, у нас это 'file'*/
        if ($file = UploadedFile::getInstance($this, 'file')) {
//            var_dump($file); die;
            /*Таким образом мы получилим информацию об загруженом обьекте. Далее его надо куда то сохранить*/
            /*Сделаем так что бы файлы сохранялись в разные папки, соответствующие какой то логике*/
            $dir = 'products/' . date("Y-m-d") . '/';

            /*Проверяем наличие данной папки, и создаем её в случае отсутствия*/
            if (!is_dir($dir)) {
                mkdir($dir);
            }

            /*Генерируем имя файла*/
            /*Что бы избежать случаев когда загружают файлы с одинаковыми именами и они могут перезаписаться
            поступаем следующим образом*/
            /*Имя загружаемого файла хранится в обьекте $file и в его свойстве baseName*/
            /*Расширение загружаемого файла хранится в обьекте $file и в его свойстве extension*/
            $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
            /*Далее надо записать путь к файлу в свойство img, которое будет записано в таблицу Product*/
            $this->img = $dir . $file_name;

            /*Далее сохраняем этот файл, с указанием куда мы его сохраняем ($this->img)*/
            $file->saveAs($this->img);

        }

        /*Здесь по умолчанию обязательно возвращать результат выполнения родительского метода*/
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
