// В этот созданный нами файл переносим все вкрапления js скриптов из шаблона
jQuery(document).ready(function ($) {

    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });

    var navoffeset = $(".agileits_header").offset().top;
    $(window).scroll(function () {
        var scrollpos = $(window).scrollTop();
        if (scrollpos >= navoffeset) {
            $(".agileits_header").addClass("fixed");
        } else {
            $(".agileits_header").removeClass("fixed");
        }
    });

    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this).stop(true, true).slideDown("fast");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this).stop(true, true).slideUp("fast");
            $(this).toggleClass('open');
        }
    );

    $().UItoTop({easingType: 'easeOutQuart'});

    $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
    });


});

$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });
});


paypal.minicart.render();

paypal.minicart.cart.on('checkout', function (evt) {
    var items = this.items(),
        len = items.length,
        total = 0,
        i;

    // Count the number of each item in the cart
    for (i = 0; i < len; i++) {
        total += items[i].get('quantity');
    }

    if (total < 3) {
        alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
        evt.preventDefault();
    }
});

/* Cart */

/* Блок кода для обработки корзины посредством Ajax */

/* Напишем функцию для показа Модального окна корзины */
function showCart(cart) {
    $('#modal-cart .modal-body').html(cart);
    $('#modal-cart').modal();
    let cartSum = $('#cart-sum').text() ? $('#cart-sum').text() : '$0';
    if (cartSum) {
        $('.cart-sum').text(cartSum);
    }
}

/*Напишем функцию getCart() которая будет делать ассинхронный запрос, доставать содержимое
корзины и показывать его:*/
function getCart() {
    $.ajax({
        url: 'cart/show',  // ссылается на экшен show в контроллере CartController
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка добавления товара');
            /* ВЫЗЫВАЕМ функцию для показа корзины */
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
}

/* Функция для удаления всех товаров из корзины */
function clearCart() {
    $.ajax({
        url: 'cart/clear',  // ссылается на экшен clear в контроллере CartController
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка');
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
}

/* Первая функция отвечает за добавление товаров в корзину Ajax запросом:
*   Если у пользователя отключен JS то функция не отработает и пользователь просто перейдет
* по дефолтному маршруту cart/add с параметром id */

$('.add-to-cart').on('click', function () {
    let id = $(this).data('id');
    $.ajax({
        url: 'cart/add',  // ссылается на экшен add в контроллере CartController
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка добавления товара');
            /* ВЫЗЫВАЕМ функцию для показа корзины */
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
    return false;
});
/* переходим обратно в CartController и продолжаем: */

/*Напишем функцию для Удаления позиции товара за счет ассинхронного запроса
    Дополним функцию тем, что если мы находимся на странице корзины то при удалении товара через модальное
    окно корзины - перезагружаем страницу самой корзины*/
$('#modal-cart .modal-body').on('click', '.del-item', function () {
    let id = $(this).data('id');
    $.ajax({
        url: 'cart/del-item',  // ссылается на экшен actionDelItem в контроллере CartController
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка действия');
            /*Дополним функцию тем, что если мы находимся на странице корзины то при удалении товара через
            модальное окно корзины - перезагружаем страницу самой корзины*/
            let now_location = document.location.pathname;
            if (now_location == '/cart/checkout') {
                location = 'cart/checkout';
            }
            /* ВЫЗЫВАЕМ функцию для показа корзины */
            showCart(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

/*Реализуем функцию добавления и убавления товаров в корзину нажатием + и -*/
$('.value-plus, .value-minus').on('click', function () {
    let id = $(this).data('id'),
        qty = $(this).data('qty');
    /*добавляем оверлей, что бы исключить случайные нажатия*/
    $('.cart-table .overlay').fadeIn();
    $.ajax({
        url: 'cart/change-cart',  // пишем в контроллере данный экшен
        data: {id: id, qty: qty},
        type: 'GET',
        /*в случае успеха выполнится это действие*/
        success: function (res) {
            if (!res) alert('Error product!');
            location = 'cart/checkout';
        },
        /*Это действи выполнится в случае Ошибки*/
        error: function () {
            alert('Error!');
        }
    });
});


/*Скопировали скрипты из фала checkout для '+' и '-' колличества товара (для примера)*/
/*$('.value-plus').on('click', function(){
    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
    divUpd.text(newVal);
});

$('.value-minus').on('click', function(){
    var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
    if(newVal>=1) divUpd.text(newVal);
});*/

/* Cart */




















