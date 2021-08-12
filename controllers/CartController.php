<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;

class CartController extends AppController
{
    /** Создали контроллер для обработки корзины */
    /* Состояние корзины будем хранить в сесии (хотя можно в куках и в других вариантахъ)
        Сессия представляет собой массив, в который по ключу можно что то положить */
    public function actionAdd($id)
    {
        /*Экшен действия добавления товара в корзину
        Так как корзина будет обрабатываться Ajax запросом - добавляем в файл main.js соотв скрипт*/
//        var_dump($id); die;

        /* создаем переменную и получаем туда информацию о товаре по указанному id */
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        /*создаем переменную $session и присваиваем её значения из контейнера которые хранятся в сессии*/
        $session = \Yii::$app->session;
        /*далее открываем сессию*/
        $session->open();
        /*далее создаем модель для сессии Cart*/

        /*уничтожаем сессию и все связанные с ней данные.*/
        /*$session->destroy();*/

        /*создаем в переменнйю $cart обьект модели и вносим туда информацию о продукте методом addToCart()*/
        $cart = new Cart();
        /*Передаем товары в корзину*/
        $cart->addToCart($product);

        /* Проверяем пришел ли данный запрос в этот метод посредством Ajax */
        if (\Yii::$app->request->isAjax) {
            /* используем метод renderPartial для ренера страницы без применения шаблона, для того
                что бы отобразить модальное окно корзины с контентом но без шаблона
            Передаем в метод renderPartial вид модального окна с параметрами из сесии */
            return $this->renderPartial('cart-modal', compact('session'));
            /* создаем вид модального окна cart-modal и далее при нажимании на add to cart
            будет возвращаться то что находится в данном модальном окне */
        }

        /* Если же запрос пришел не AJAX то просто возвращаем пользователя на предыдущую страницу */
        return $this->redirect(\Yii::$app->request->referrer);

    }

    public function actionShow()
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session'));
    }

    /*Экшен показа оставшихся товаров корзины после удаления товара*/
    public function actionDelItem()
    {
        /*получим id удаляемого товара напрямую из массива Гет для разнообразия*/
        $id = \Yii::$app->request->get('id');

        /* Далее необходимо обратиться к сессии что бы удалить из нее ненужный тавар */
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();

        /* Вызываем метод пересчета корзины который написали в модели Cart */
        $cart->recalc($id);

        /* И далее возвращаем новую корзину */

        /*В виде корзины(checkout) удаление обьектов будет не через Аякс, по этому надо сделать проверку
        1 - Если запрос на удаление пришел Аяксом то рендерим cart-modal без шаблона
        2 - если пришел не Аяксом то прост оперезагрушаем страницу с обновленными данными*/
        if (\Yii::$app->request->isAjax) {
            return $this->renderPartial('cart-modal', compact('session'));
        }
        /*делаем редирект на ту страницу с которой пришел пользователь*/
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /* Пишем экшен для полной очистки корзины */
    public function actionClear()
    {
        $session = \Yii::$app->session;
        $session->open();
        /* Используем метод Yii2 remove() для очистки корзины */
        $session->remove('cart');  // очистит все товары
        $session->remove('cart.qty');  // очистит итоговое колличество
        $session->remove('cart.sum');  // очистит итоговую сумму
        return $this->renderPartial('cart-modal', compact('session'));
    }

    /* Пишем экшен оформления товаров в корзине */
    public function actionCheckout()
    {
        $this->setMeta("Оформление заказа :: " . \Yii::$app->name);
        /*Обратимся к компоненту session и передадим его в представление:*/
        $session = \Yii::$app->session;
        /*создаем обьект модели для модели Order и передаем её в представление, для того что бы
            на основе её атрибутов создать необходимую форму*/
        $order = new Order();

        /*Создадим обьект для второй таблицы:*/
        $order_product = new OrderProduct();

        /*Проверяем, если данные загрузились в модель $order методом post то дополнительно загружаем
        еще значения колличества и суммы:*/
        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];

            /*Далее надо сохранять данные в 2 таблицы. Воспользуемся документацией, раздел
            Active Record -> Работа с транзакциями. Вместо Customer можно использовать Yii::app */
            $transaction = \Yii::$app->getDb()->beginTransaction();

            /*Сохраняем данные для модели Order:*/
            /*Если данные не сохранены(если save() или saveOrderProducts вернет false) */
            if (!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)) {
                /*Если откатываем транзакцию - то надо сообщить пользователю:*/
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа!');

                /*ОТКАТЫВАЕМ транзакцию*/
                $transaction->rollBack();
            } else {
                /*Иначе - выполняем транзакцию*/
                $transaction->commit();
                /*Если все збс то пишем сообщение о збс*/
                \Yii::$app->session->setFlash('success', 'Заказ оформлен!!!');

                /*Напишем блок отлова ошибок при отправке писем*/
                try {
                    /** Настраиваем отправку письма после усепшного формирования заказа */
                    /* Первым делом передаем представление с содержимым письма compose('order'...
                     * метод setFrom() можно просто 'строкой' задавать емаил отправителя, либо задавать
                по красоте в виде массива, Например: [email] => [Название организации]. Тогда
                в пришедшем емейле будет высвечиваться Название организации а не просто емеил
                    * setTo() - либо 'строкой' задавать одного получателя, либо в массиве
                задавать адреса нескольких получателей. В нашем случае отправляем 2 письма:
                1 - отправляем пользователю, его почту берем из модели order->email
                2 - письмо отправляем админу config/params -> adminEmail
                    * setSubject() - метод для формирования темы письма
                    * send() - метод который отправляет письмо*/
                    \Yii::$app->mailer->compose('order', ['session' => $session])
                        ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                        ->setTo([$order->email, \Yii::$app->params['adminEmail']])
                        ->setSubject('Заказ на сайте')
                        ->send();
                } catch (\Swift_TransportException $e) {
                    var_dump($e); die;
                }


                /*Далее надо очистить корзину:*/
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                /*И обновляем страницу*/
                return $this->refresh();
            }


        }
        /*Для того что бы отловить ошибки дополнительно передаем модель order_product, и в виде
        checkout распечатать (debug) их свойства errors*/
        return $this->render('checkout', compact('session', 'order', 'order_product'));
    }

    /*Пишем экшен для изменения корзины (добавления и убавления товаров нажатием + и -)
        параметры id можно получать либо задавая их в экшен либо получая напрямую из массива ГЕТ*/
    public function actionChangeCart()
    {
        /*Получаем параметры id и qty напрямую из ГЕТ*/
        $id = \Yii::$app->request->get('id');
        $qty = \Yii::$app->request->get('qty');

        /*Получаем данные в переменную*/
        $product = Product::findOne($id);
        /*Проверяем пришли ли данные*/
        if (empty($product)) {
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        /*Передаем товары в корзину:*/
        $cart->addToCart($product, $qty);
        return $this->renderPartial('cart-modal', compact('session'));
        /*Далее переходим в модель Cart и добавляем в метод addToCart проверку колличества qty*/
    }

}



















