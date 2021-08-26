<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $title
 * @property float $price
 * @property int $qty
 * @property float $total
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /** Связываем 2 модели, OrderProduct и Order: */
    public function getOrder()
    {
        /*Так как будем получать 1 заказ воспользуемся методом hasOne
        связываем колонку order_id модели OrderProduct с колонкой id модели Order */
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'title' => 'Title',
            'price' => 'Price',
            'qty' => 'Qty',
            'total' => 'Total',
        ];
    }
}
