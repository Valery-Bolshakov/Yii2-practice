<!--Страница вида корзины, контент который отображается при заходе в корзину.-->
<!--Проверяем, если в корзину были добавлены товары, тогда мы выводим таблицу с ними:-->
<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <!--Убрал Иконку для УДАЛЕНИЯ позиции товара(class="glyphicon glyphicon-remove" aria-hidden="true")-->
                <th><span> </span></th>
            </tr>
            </thead>
            <tbody>
            <!--Проходим циклом по свойствам товара и выводим их значения в виде таблицы:-->
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td><?= \yii\helpers\Html::img("@web/{$item['img']}",
                            ['alt' => $item['title'], 'height' => 50]) ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <!--Иконка для УДАЛЕНИЯ позиции товара. За счет data-id="$id" атрибута -
                     - скрипт будет принимать id товара который необходимо удалить.-->
                    <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item"
                              aria-hidden="true"></span></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="2">Итого:</td>
                <td colspan="3" id="cart-qty"><?= $session['cart.qty'] ?></td>
            </tr>
            <tr>
                <td colspan="3">На сумму:</td>
                <td colspan="2" id="cart-sum">$<?= $session['cart.sum'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<!--Если корзина пустая - тогда выводим следующее:-->
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>