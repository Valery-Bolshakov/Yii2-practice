<!--СТРАНИЦА ВЫВОДА ТОВАРОВ СОГЛАСНО ЗАПРАШИВАЕМОЙ КАТЕГОРИИ-->
<!-- products-breadcrumb | хлебные крошки -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i>
                <a href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <li><?= $category->title ?></li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->

<!-- banner -->
<div class="banner">
    <!--    Подключаем сайдбар в виды запрашиваемых категорий-->
    <?= $this->render('//layouts/inc/sidebar') ?>

    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="w3l_banner_nav_right_banner3_btm">
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/13.jpg" alt=" " class="img-responsive"/>
                    <div class="mask">
                        <h4>Utensils</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod magna aliqua.</p>
                    </div>
                </div>
                <h4>Utensils</h4>
                <ol>
                    <li>sunt in culpa qui officia</li>
                    <li>commodo consequat</li>
                    <li>sed do eiusmod tempor incididunt</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/14.jpg" alt=" " class="img-responsive"/>
                    <div class="mask">
                        <h4>Hair Care</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod magna aliqua.</p>
                    </div>
                </div>
                <h4>Hair Care</h4>
                <ol>
                    <li>enim ipsam voluptatem officia</li>
                    <li>tempora incidunt ut labore et</li>
                    <li>vel eum iure reprehenderit</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/15.jpg" alt=" " class="img-responsive"/>
                    <div class="mask">
                        <h4>Cookies</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod magna aliqua.</p>
                    </div>
                </div>
                <h4>Cookies</h4>
                <ol>
                    <li>dolorem eum fugiat voluptas</li>
                    <li>ut aliquid ex ea commodi</li>
                    <li>magnam aliquam quaerat</li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w3ls_w3l_banner_nav_right_grid">
<!--            Выводим название категории, берем его из таблицы:-->
            <h3><?= $category->title ?></h3>
<!--            Проверим Если в $products пришли продукты, полученные в  CategoryController то выводим их-->
            <?php if (!empty($products)): ?>
                <div class="w3ls_w3l_banner_nav_right_grid1">
    <!--                Далее в исходном html коде выводится 4 продукта, оставляем 1 остальные удаляем-->
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-3 w3ls_w3l_banner_left">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                    <?php if ($product->is_offer): ?>
                                        <div class="agile_top_brand_left_grid_pos">
                                            <?= yii\helpers\Html::img('@web/images/offer.png',
                                                ['alt' => 'offer', 'class' => 'img-responsive']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="<?= yii\helpers\Url::to(['product/view', 'id' =>$product->id]) ?>">
                                                        <?php if ($product->img) : ?>
                                                            <?= yii\helpers\Html::img("@web/products/{$product->img}",
                                                                ['alt' => $product->title]) ?>
                                                        <?php else: ?>
                                                            <?= yii\helpers\Html::img("@web/products/no-image.png",
                                                                ['alt' => $product->title]) ?>
                                                        <?php endif; ?>
                                                    </a>
                                                    <p><?= $product->title ?></p>
                                                    <h4>
                                                        $<?= $product->price ?>
                                                        <?php if ((float)$product->old_price): ?>
                                                            <span>$<?= $product->old_price ?></span>
                                                        <?php endif; ?>
                                                    </h4>
                                                </div>
                                                <!--Меняем код корзины, копирую его из главного вида, Не забываем
                                                менять параметры из которых получаем id товара-->
                                                <div class="snipcart-details">
                                                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                       data-id="<?= $product->id ?>" class="button add-to-cart">Add to cart</a>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                    <!--Регистрируем на странице ПАГИНАЦИЮ-->
<!--                    обернем её в какой нибудь класс:-->
                    <div class="col-md-6">
                        <!--Обращаемся к виджету LinkPager и вписываем необходимые параметры.
                        У данного виджета есть различные методы и свойства, передавая их массивом
                        можно изменять внешний вид и настройки пагинации например:
                        nextPageCssClass стрелочке добавили клас-->
                        <?= \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                                'nextPageCssClass' => 'next test',  // стрелочке добавили клас test
//                                'maxButtonCount' => 5  // Максимальное количество отображаемых кнопок страниц.
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="w3ls_w3l_banner_nav_right_grid1">
                    <h2>В категории <i><?= $category->title ?></i> товаров пока нет!</h2>
                </div>
            <?php endif; ?>

<!--            VEGETABLES & FRUITS и BEVERAGES пока что закомментировал-->
            <!--<div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>vegetables & fruits</h6>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/9.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh spinach (palak)</p>
                                            <h4>$2.00 <span>$3.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh spinach"/>
                                                    <input type="hidden" name="amount" value="2.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/10.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh mango dasheri (1 kg)</p>
                                            <h4>$5.00 <span>$8.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh mango dasheri"/>
                                                    <input type="hidden" name="amount" value="5.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive"/></div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/11.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh apple red (1 kg)</p>
                                            <h4>$6.00 <span>$8.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh apple red"/>
                                                    <input type="hidden" name="amount" value="6.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/12.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>fresh broccoli (500 gm)</p>
                                            <h4>$4.00 <span>$6.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="fresh broccoli"/>
                                                    <input type="hidden" name="amount" value="4.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>beverages</h6>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/13.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>mixed fruit juice (1 ltr)</p>
                                            <h4>$3.00 <span>$4.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="mixed fruit juice"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/14.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>prune juice - sunsweet (1 ltr)</p>
                                            <h4>$4.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="prune juice"/>
                                                    <input type="hidden" name="amount" value="4.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="tag"><img src="images/tag.png" alt=" " class="img-responsive"/></div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/15.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>coco cola zero can (330 ml)</p>
                                            <h4>$3.00 <span>$5.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="coco cola can"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="images/offer.png" alt=" " class="img-responsive"/>
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="single.html"><img src="images/16.png" alt=" "
                                                                       class="img-responsive"/></a>
                                            <p>sprite bottle (2 ltr)</p>
                                            <h4>$3.00 <span>$4.00</span></h4>
                                        </div>
                                        <div class="snipcart-details">
                                            <form action="#" method="post">
                                                <fieldset>
                                                    <input type="hidden" name="cmd" value="_cart"/>
                                                    <input type="hidden" name="add" value="1"/>
                                                    <input type="hidden" name="business" value=" "/>
                                                    <input type="hidden" name="item_name" value="sprite bottle"/>
                                                    <input type="hidden" name="amount" value="3.00"/>
                                                    <input type="hidden" name="discount_amount" value="1.00"/>
                                                    <input type="hidden" name="currency_code" value="USD"/>
                                                    <input type="hidden" name="return" value=" "/>
                                                    <input type="hidden" name="cancel_return" value=" "/>
                                                    <input type="submit" name="submit" value="Add to cart"
                                                           class="button"/>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>-->
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->