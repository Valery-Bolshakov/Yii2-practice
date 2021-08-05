<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{
    // Наследуем как обыччно Обший(Главный) Контроллер приложения AppController

    public function actionView($id)
    {
        /** Экшен для вывода продуктов запрашиваемых категорий */

//        Параметром данный экшен будет принимать id категории

//        var_dump($id);  // Проверим приходит ли id категории при переходе по ссылке в меню

        /*Получаем данные о текущей категориии: Обращаемся к модели Category, и так как категория по id
        может быть получена только Одна - воспользуемся методом findOne.*/
        $category = Category::findOne($id);

        /*Реализуем проверку на актуальность id параметра, что бы избежать устаревших или несуществующих
        ссылок, на случай если пользователь сам введет id в адресной строке:
        Если $category окажется пустой (полученый гет параметром id не существует в таблице category) -
        то выбрасываем 404 исключение (ответ)
        Так же в файле site/error меняем текст и внешний вид ошибки  */
        if (empty($category)) {
            throw new NotFoundHttpException('Данной страницы не существует');
        }

        /*Вызываем метод setMeta который написали в AppController, запишем в него title + название сайта
        и остальные параметры. И теперь в названиях окон будет выводиться title раздела приложения*/
        $this->setMeta("{$category->title} :: " . \Yii::$app->name, $category->keywords, $category->description);


        /*Далее получаем продукты данной категории. Создадам страницу products и получим в нее все продукты
        согласно переданному id категории
        Кстати, значения category_id в таблице product ссылаются к id столбцу таблицы category
          Закомментируем получение и вывод продуктов в виде и ниже реализуем Пагинацию*/
//        $products = Product::find()->where(['category_id' => $id])->all();

        /** Пагинация: */
        /*Создаем обьект запроса и передадим ему данные с таблицы согласно запросу:*/
        $query = Product::find()->where(['category_id' => $id]);

        /*Далее создаем переменную $pages и создаем новый обьект класса пагинации с нужными параметрами:
        в параметр totalCount передается колличество записей из $query, которые посчитает метод count()
        А вторым параметром pageSize мы устанавливаем какое число записей выводить на одной странице.
            Настраиваем ЧПУ для пагинации:
        - 'forcePageParam' => false - на первой странице пагинации будет ЧПУ url
        - 'pageSizeParam' => false - избавились от &per-page=2 в адресе*/
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false,
            'pageSizeParam' => false]);

        /*Далее создаем переменную $products и вписываем в нее необходимые параметры по колличеству товаров*/
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        /*Далее передаем данные в представление что бы они отобразились: compact('pages')*/


        /*Далее рендерим вид view и передаем в него id категории compact('category') и полученные
        по id продукты данной категории - compact('products')*/
        return $this->render('view', compact('products', 'category', 'pages'));
    }


    public function actionSearch()
    {
        /** Экшен для Поиска */

        /*Так как в форме отправки поиска у инпута name="q" - создаем соотв переменную, которую будем вытаскивать
        из контейнера приложения и массива get. Если в контейнере приложения в массиве get у параметра q
        не будет задано какое нибудь значение то просто вернется null */
        $q = trim(\Yii::$app->request->get('q'));  // обрежем пробелы
//        var_dump($q);
//        Установим тайтл страницы
        $this->setMeta("Поиск: {$q} :: " . \Yii::$app->name);

//         Если переменная $q ПУСТА то просто возвращаем представление
        if (!$q) {
            return $this->render('search');
        }
//        Если переменная $q НЕ ПУСТА то совершаем запрос. - Формат операторов, Например, ['like', 'name', 'test']
        $query = Product::find()->where(['like', 'title', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false,
            'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('products', 'pages', 'q'));

    }
}