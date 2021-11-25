<option
    value="<?= $category['id'] ?>"
    <?php if ($category['id'] == $this->model->category_id) echo ' selected'?>
>
    <?= " {$tab} {$category['title']} " ?>
</option>
<?php if (isset($category['children'])): ?>
    <?php /*Рекурсивно обращаемся к getMenuHtml и выводим категории потомков в родительской категории
 так же добавляем к параметру tab - дефис, для реализования отступа в категориях*/ ?>
    <?= $this->getMenuHtml($category['children'], $tab . '-') ?>
<?php endif; ?>
