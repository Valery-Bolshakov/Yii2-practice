<!--СТРАНИЧКА КАРТОЧКИ ТОВАРА-->
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i>
                <a href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <!--Что бы в крошки вписать название категории, в которой находится товар, необходимо установить
            связь между моделями Product and Category. Связь устанавливаем в модели Product
            с помощью метода getCategory(). Далее мы можем использовать любые свойства таблицы category
            посредством конструкции $product->category->... Примеры ниже-->
            <li>
                <a href="<?= \yii\helpers\Url::to(['category/view', 'id'=>$product->category->id]) ?>">
                    <?= $product->category->title ?></a><span>|</span>
<!--                Напишем Второй вариант формирования ссылок с помощью helpers\Html-->
                <?/*= \yii\helpers\Html::a($product->category->title,
                    ['category/view', 'id'=>$product->category->id]) */?><!--<span>|</span>-->
            </li>
            <li><?= $product->title ?></li><!--Выводим название товара-->
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?>

    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="agileinfo_single">
            <h5><?= $product->title ?></h5><!--Подставляем запрашиваемое название товара-->
            <div class="col-md-4 agileinfo_single_left"><!--Подставляем запрашиваемое Картинку товара-->
                <?= yii\helpers\Html::img("@web/images/{$product->img}",
                    ['alt' => 'example', 'class' => 'img-responsive']) ?>
            </div>
            <div class="col-md-8 agileinfo_single_right">
                <div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
                </div>
                <div class="w3agile_description">
                    <h4>Description :</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                        officia deserunt mollit anim id est laborum.Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.</p>
                </div>
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <!--Подставляем запрашиваемую Цену товара-->
                        <h4>
                            $<?= $product->price ?>
                            <?php if ((float)$product->old_price): ?>
                                <span>$<?= $product->old_price ?></span>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="snipcart-details agileinfo_single_right_details">
                        <form action="#" method="post">
                            <fieldset>
                                <input type="hidden" name="cmd" value="_cart"/>
                                <input type="hidden" name="add" value="1"/>
                                <input type="hidden" name="business" value=" "/>
                                <input type="hidden" name="item_name" value="pulao basmati rice"/>
                                <input type="hidden" name="amount" value="21.00"/>
                                <input type="hidden" name="discount_amount" value="1.00"/>
                                <input type="hidden" name="currency_code" value="USD"/>
                                <input type="hidden" name="return" value=" "/>
                                <input type="hidden" name="cancel_return" value=" "/>
                                <input type="submit" name="submit" value="Add to cart" class="button"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->
