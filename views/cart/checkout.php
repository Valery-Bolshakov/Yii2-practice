<!--ЭКШЕН ОФОРМЛЕНИЯ ТОВАРОВ ЛЕЖАЩИХ В КОРЗИНЕ-->

<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i>
                <a href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <li>Оформление товара</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?>

    <div class="w3l_banner_nav_right">
        <!-- about -->
        <div class="privacy about">

            <!--выводим флешсообщение-->
            <?= \app\widgets\Alert::widget() ?>
            <h3>Checkout</h3>

            <?php if (!empty($session['cart'])): ?>
                <div class="checkout-right">
                    <h4>Your shopping cart contains: <span><?= $session['cart.qty'] ?> Product(s)</span></h4>
                    <!--дополнительно обернем таблицу в класс cart-table и внутри дива поместим оверлей
                     Overlay (оверлей), или перекрывающий слой - это слой, который обычно накладывают
                     поверх фонового изображения-->
                    <div class="cart-table">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <table class="timetable_sub">
                            <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--Запускаем foreach цикл, проходимся по товарам в корзине и вписываем информацию
                                по товару в переменную $item:-->
                            <?php $i = 1;
                            foreach ($session['cart'] as $id => $item): ?>
                                <!--Оставляем один товар для примера, остальные удаляем-->
                                <tr>
                                    <td class="invert"><?= $i ?></td>
                                    <!--вставляем адекватную ссылку на картинку-->
                                    <td class="invert-image">
                                        <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>">
                                            <?= \yii\helpers\Html::img("@web/{$item['img']}",
                                                ['alt' => $item['title']]) ?>
                                        </a>
                                    </td>
                                    <td class="invert">
                                        <div class="quantity">
                                            <div class="quantity-select">
                                                <!--добавим дейта атибудты для убавления и прибавления колличества
                                                    и data id:-->
                                                <div class="entry value-minus" data-id="<?= $id ?>" data-qty="-1">
                                                    &nbsp;
                                                </div>
                                                <!--ставляем колличество добавленого товара-->
                                                <div class="entry value"><span><?= $item['qty'] ?></span></div>
                                                <div class="entry value-plus active" data-id="<?= $id ?>" data-qty="1">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="invert"><?= $item['title'] ?></td>
                                    <td class="invert"><?= $item['price'] ?></td>
                                    <td class="invert">
                                        <div class="rem">
                                            <!--Вставляем ссылку на экшен DelItem контроллера CartController-->
                                            <a class="close1"
                                               href="<?= \yii\helpers\Url::to(['cart/del-item', 'id' => $id]) ?>"></a>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="checkout-left">
                    <div class="col-md-4 checkout-left-basket">
                        <h4>Continue to basket</h4>
                        <ul>
                            <?php foreach ($session['cart'] as $item): ?>
                                <li><?= $item['title'] ?><i>:</i> <span>$<?= $item['price'] * $item['qty'] ?></span>
                                </li>
                            <?php endforeach; ?>
                            <li>Total <i>:</i> <span>$<?= $session['cart.sum'] ?></span></li>
                        </ul>
                    </div>
                    <!--Создаем форму согласно требованиям:
                    Может возникнуть ошибка в конфликте подключаемых js файлов,
                    идем в AppAssets и решаем ошибку-->
                    <div class="col-md-8 address_form_agile">
                        <h4>Данные покупателя:</h4>
                        <?php $form = \yii\widgets\ActiveForm::begin() ?>
                        <?= $form->field($order, 'name') ?>
                        <?= $form->field($order, 'email') ?>
                        <?= $form->field($order, 'phone') ?>
                        <?= $form->field($order, 'address') ?>
                        <?= $form->field($order, 'note')->textarea(['rows' => 3]) ?>
                        <!--Задаем кнопку для формы, класс кнопки берем из верстки и вставляем массивом-->
                        <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'submit check_out']) ?>
                        <?php \yii\widgets\ActiveForm::end() ?>
                    </div>

                    <div class="clearfix"></div>

                </div>
            <?php else: ?>
                <h3>Корзина пуста</h3>
            <?php endif; ?>

        </div>
        <!-- //about -->
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->
