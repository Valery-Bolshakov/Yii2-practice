<!--Создали файл который формирует внешний вид(верстка) виджета меню и задает
ссылки на категории продуктов виджета-->

<!--Экспериментирую с данной ссылкой-->
<?//= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>

<!--Если для категории существует потомок - то присваеваем ему класс dropdown.
такую же херню пишем для тега <a> с некоторыми дополнениями-->
<li <?php if (isset($category['children'])) echo 'class="dropdown"' ?>>
<!--    Url::to формирует ссылку типа: http://yii2-practice/web/index.php?r=category%2Fview&id=1
        category - контроллер, view - вид, id=1 - ид страницы. И далее отрабатываем условие:
        if (isset($category['children'])) Если данная категория имеет потомков - дописываем ей
        соответствующие классы: (взяты из html кода данной страницы)

        Изменим вид ссылок на category/1, для этого переходим в файл config/web и в разделе urlManager
        записываем правила ссылок в массив rules. Правила взяты в разделе Генерация ЧПУ

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

