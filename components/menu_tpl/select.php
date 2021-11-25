<?php /**/ ?>
<?php /*Создали шаблон для MenuWidget
 делаем так что бы родительская категория выделялась по умолчанию
 Для этого пишем условие - если данная категория равна перент_айди то устанавливаем в этом пункте
 настройку selected
 И добавляем условие что было нельзя выбрать собственную категорию(ту которую редактируем)*/ ?>
<option
        value="<?= $category['id'] ?>"
        <?php if ($category['id'] == $this->model->parent_id) echo ' selected'?>
        <?php if ($category['id'] == $this->model->id) echo ' disabled'?>
>
    <?= " {$tab} {$category['title']} " ?>
</option>
<?php if (isset($category['children'])): ?>
    <?php /*Рекурсивно обращаемся к getMenuHtml и выводим категории потомков в родительской категории
 так же добавляем к параметру tab - дефис, для реализования отступа в категориях*/ ?>
    <?= $this->getMenuHtml($category['children'], $tab . '-') ?>
<?php endif; ?>
