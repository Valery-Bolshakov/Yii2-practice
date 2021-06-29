
<!--Если для категории существует потомок - то присваеваем ему класс dropdown.
такую же херню пишем для тега <a> с некоторыми дополнениями-->
<li <?php if (isset($category['children'])) echo 'class="dropdown"' ?>>
<!--    Получаем ссылки вида category/view?id=1 с Гет параметнами id категорий
        'category/view' - указали путь до контролллера category и вида view

        Изменим вид ссылок на category/1, для этого переходим в файл config/web и в разделе urlManager
        записываем правила ссылок в массив rules. Правила взяты в разделе Генерация ЧПУ

        if: Если данная категория имеет потомков - дописываем ей соответствующие классы: (взяты из html кода)
        -->
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>"
        <?php if (isset($category['children'])) echo 'class="dropdown-toggle" data-toggle="dropdown"' ?>>
        <!--$category['title'] выводит название категорий. Тут мы обращаемся к файлу виджета, там где циклом
        проходимся по категориям и вытаскиваем значения поля title-->
        <?= $category['title'] ?>
<!--        Выводим значки стрелочек для Родительских категорий:-->
        <span <?php if (isset($category['children'])) echo 'class="caret"' ?>></span>
    </a>

<!--    Выводим потомков если таковые имеются: Если в текущей категории имеются потомки -
        Разметку для классов потомков берем их кода sidebar -->
    <?php if (isset($category['children'])): ?>
<!--    Выводим эти самые потомки:-->
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
<!--                    Рекурсивно обращаемся к getMenuHtml и выводим категории потомков в родительской категории-->
                    <?= $this->getMenuHtml($category['children']) ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</li>

