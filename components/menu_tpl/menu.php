
<!--Если для категории существует потомок - то присваеваем ему класс dropdown.
такую же херню пишем для тега <a> с некоторыми дополнениями-->
<li <?php if (isset($category['children'])) echo 'class="dropdown"' ?>>
<!--    Получаем ссылки вида category/view?id=1 с Гет параметнами id категорий
        'category/view' - указали путь до контролллера category и вида view-->
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>"
        <?php if (isset($category['children'])) echo 'class="dropdown-toggle" data-toggle="dropdown"' ?>>
        <!--$category['title'] выводит название категорий. Тут мы обращаемся к файлу виджета, там где циклом
        проходимся по категориям и вытаскиваем значения поля title-->
        <?= $category['title'] ?>
    </a>
</li>

<!---14 минут-->