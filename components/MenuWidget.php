<?php


namespace app\components;


use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget  // Расширяем как правило yii\base\Widget
{
//    Данное свойство вводим для того что бы виджет был более универвсальным и работал с разынми шаблонами
    public $tpl;
//    Посредством данного свойства будем присваивать css классы для меню виджета
    public $ul_class;

    public $data;  // будем получать массив категорий
    public $tree;  // будем формировать дерево виджета
    public $menuHtml;  // здесь будет готовая верстка меню, которая будет возвращать метод run

    public function init()
    {
//        Метод должен возвращать результат родительского метода ::init()
        parent::init();

        if ($this->ul_class === null) {  //
            $this->ul_class = 'menu';  //
        }

        if ($this->tpl === null) {  // если свойство tpl не передано (т.е. = null)
            $this->tpl = 'menu';  // то просто возвращаем меню
        }
//        и добавляем к нему расширение php
        $this->tpl .= '.php';
    }

    public function run()
    {
        /*Для начала получим все категории нашего приложения
        Обращаемся к свойству data и записываем в него все категории которые имеются в модели Category
        Дописываем настройки запроса: Используем метод ->asArray() что бы получить массив массивов
        Укажем что бы ключи массивов совпадали с id обьектов (для удобства) ->indexBy('id')
        Укажем какие колонки необходимо выводить ->select('...') либо ->select([...])

        При каждом обновлении страницы происходит sql запрос к БД и обработка скрипта построения дерева меню
        Добавим кеширование данных что бы снизить потребляемые ресурсы на запрос и обработку при обновлении.
        Это достигается посредством использования методов get() и set()
        */

        /*get cache
        в переменной $menu получим данные из кеша. Для этого обращаемся к контейнеру Yii::app к компоненту
        cache и методом get попробуем получить данные(Данные будем хранить по ключю menu)
        */
        $menu = \Yii::$app->cache->get('menu');
//            Если данные получены в меню - то ваозвращаем эти данные
        if ($menu) {
            return $menu;
        }

//            Если данные HE получены в меню - то выполняем все операции ниже:
        $this->data = Category::find()->select('id, parent_id, title')->indexBy('id')
            ->asArray()->all();
//        Строим дерево массива (дерево виджета меню)
        $this->tree = $this->getTree();
//        Обернем меню виджета в нужный нам класс
        $this->menuHtml = '<ul class="' . $this->ul_class . '">';

        $this->menuHtml .= $this->getMenuHtml($this->tree);  // дописываем и получаем наше меню
//        закрываем тег ul дописывая его в общую строку
        $this->menuHtml .= '</ul>';

        /*set cache
        По окончанию этих операций нам надо закешировать данные*/
        \Yii::$app->cache->set('menu', $this->menuHtml, 60); // кешируем данные на  60 сек
//        В реальности данные кешируются в зависимости от того как часто меняется структура меню категорий
//        кеш хранится в папке runtime/cache

//        Проверим приходит ли новый массив категорий $tree = []
//        debug($this->tree);

//        Возвращаем меню
        return $this->menuHtml;
    }

//    Далее пишем метод для получения дерева виджета $tree = [] (Функция для формирования меню)
    protected function getTree()
    {
        $tree = [];
        // передаем ключ=>значение $id => &$node где значение передаем по ссылке &
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) { // если parent_id не равно 0 то это Самостоятельная категория
                $tree[$id] = &$node;
            } else {  // В противном случае мы его вкладываем в самостоятельную категорию
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree)
    {
        /*Метод getMenuHtml() проходится циклом по категориям массива дерева $tree и применяет
        метод catToTemplate() для каждой категории $category. И записывает её в строку $str.*/
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;  // Возвращаем строку с уже сформированным html кодом
    }

    protected function catToTemplate($category)
    {
        /*Данный метод применяет шаблон верстки из подключаемого файла для каждого
        переданого ему обьекта $category. Данные записываем в буфер ob_start()*/
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
//        Возвращаем данные из буфера и очищаем его
        return ob_get_clean();
    }

}

















