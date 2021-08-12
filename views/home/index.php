<!--Открывающий тег <div class="banner"> переносим в шаблон grocery,
И после него рендерим sidebar, вставляя перед $content-->
<!-- banner -->
<div class="banner">
<!--    Подключаем сайдбар в главный вид-->
    <?= $this->render('//layouts/inc/sidebar') ?>

<!--Так как левая часть контента тоже неизменна (меню продуктов)- создаем отдельный вид layouts/inc/sidebar
и вынесем её в отдельный вид подключаемый sidebar.
Открывающий тег <div class="banner"> переносим в шаблон grocery, вставляя перед $content-->

    <div class="w3l_banner_nav_right">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div class="w3l_banner_nav_right_banner">
                            <h3>Make your <span>food</span> with Spicy.</h3>
                            <div class="more">
                                <a href="products.html" class="button--saqui button--round-l button--text-thick"
                                   data-text="Shop now">Shop now</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w3l_banner_nav_right_banner1">
                            <h3>Make your <span>food</span> with Spicy.</h3>
                            <div class="more">
                                <a href="products.html" class="button--saqui button--round-l button--text-thick"
                                   data-text="Shop now">Shop now</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w3l_banner_nav_right_banner2">
                            <h3>upto <i>50%</i> off.</h3>
                            <div class="more">
                                <a href="products.html" class="button--saqui button--round-l button--text-thick"
                                   data-text="Shop now">Shop now</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>
</div>
<!-- banner -->

<div class="banner_bottom">
    <div class="wthree_banner_bottom_left_grid_sub">
    </div>
    <div class="wthree_banner_bottom_left_grid_sub1">
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/4.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_bottom_left_grid_pos">
                    <h4>Discount Offer <span>25%</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/5.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_btm_pos">
                    <h3>introducing <span>best store</span> for <i>groceries</i></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/6.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_btm_pos1">
                    <h3>Save <span>Upto</span> $10</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>

<!-- top-brands -->
<!--проверяем наличие товаров в блоке Hot Offers
в $offers лежат первые 4 товара таблицы product которые мы получили в файле HomeController -->
<?php if (!empty($offers)): ?>
<div class="top-brands">
    <div class="container">
        <h3>Hot Offers</h3>
        <div class="agile_top_brands_grids">
<!--            имеем 4 товара в данном блоке, 3 удалим, 1 оставим для примера.
                проходимся циклом по тем 4ем товарам которые лежат в переменной $offers и подставляем
                где нужно значения из свойств ("$offer->id")-->
            <?php foreach ($offers as $offer): ?>
<!--            внутри цикла надо выводить соотв элементы товаров данного блока-->
            <div class="col-md-3 top_brand_left">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
                        <div class="agile_top_brand_left_grid_pos">
<!--                            Для формирования изображения воспользуемся helpers\Html и методом img()
 параметр 'class' => 'img-responsive' взяли из удаленного позднее html кода, для правильного отображения картинки-->
                            <?= yii\helpers\Html::img('@web/images/offer.png',
                                ['alt' => 'offer', 'class' => 'img-responsive']) ?>
                        </div>
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block" >
                                    <div class="snipcart-thumb">
<!--                                        Ссылку тоже заменяем на хелпер юрл и картинку товара тоже изменим
Указываем маршрут до будущего контроллера Product и вида view, id нужного товара хранится в $offer и
его свовстве id ($offer->id)
Далее меняем картинку товара, указываем путь на папку product в корневой дирректории web (@web/products/).
А название картинки берем из свойства $offer по ключу img из таблицы product -->
                                        <a href="<?= yii\helpers\Url::to(['product/view', 'id' =>$offer->id]) ?>">
                                            <?= yii\helpers\Html::img("@web/products/{$offer->img}",
                                                ['alt' => $offer->title]) ?>
                                        </a>
<!-- Название в картинки берем из свойства $offer->title которое обратится к нужному разделу $offer поля title -->
                                        <p><?= $offer->title ?></p>
                                        <!--Подставляем старый и новый ценники из таблицы-->
                                        <h4>
                                            $<?= $offer->price ?>
<!--                                        Приводим old_price к типу(float) т.к. изначально значение
                                            передавалось как строчное
                                            если $offer->old_price >= 0 то вернет true и условие отработает-->
                                            <?php if ((float)$offer->old_price): ?>
                                                <span>$<?= $offer->old_price ?></span>
                                            <?php endif; ?>
                                        </h4>
                                    </div>

<!--                                    Корзина-->
                                    <div class="snipcart-details top_brand_home_details">
                                        <!--Вместо формы с корзиной вставляем ссылку на контроллер и вид, которые
                                        будут отвечать за добавление товара в корзину, id указываем из кода выше
                                        и добавляем необходимые настройки.
                                        Так же из оригинала копируем стили для корзины
                                        Далее копируем этот код и вставляем его в остальные виды-->
                                        <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $offer->id]) ?>"
                                           data-id="<?= $offer->id ?>" class="button add-to-cart">Add to cart</a>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- //top-brands -->

<!-- fresh-vegetables -->
<div class="fresh-vegetables">
    <div class="container">
        <h3>Top Products</h3>
        <div class="w3l_fresh_vegetables_grids">
            <div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
                <div class="w3l_fresh_vegetables_grid2">
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">All Brands</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Vegetables</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Fruits</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="drinks.html">Juices</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="pet.html">Pet Food</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="bread.html">Bread & Bakery</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="household.html">Cleaning</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Spices</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dry Fruits</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dairy Products</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 w3l_fresh_vegetables_grid_right">
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <img src="images/8.jpg" alt=" " class="img-responsive" />
                    </div>
                </div>
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <div class="w3l_fresh_vegetables_grid1_rel">
                            <img src="images/7.jpg" alt=" " class="img-responsive" />
                            <div class="w3l_fresh_vegetables_grid1_rel_pos">
                                <div class="more m1">
                                    <a href="products.html" class="button--saqui button--round-l button--text-thick"
                                       data-text="Shop now">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w3l_fresh_vegetables_grid1_bottom">
                        <img src="images/10.jpg" alt=" " class="img-responsive" />
                        <div class="w3l_fresh_vegetables_grid1_bottom_pos">
                            <h5>Special Offers</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <img src="images/9.jpg" alt=" " class="img-responsive" />
                    </div>
                    <div class="w3l_fresh_vegetables_grid1_bottom">
                        <img src="images/11.jpg" alt=" " class="img-responsive" />
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="agileinfo_move_text">
                    <div class="agileinfo_marquee">
                        <h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
                    </div>
                    <div class="agileinfo_breaking_news">
                        <span> </span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //fresh-vegetables -->
