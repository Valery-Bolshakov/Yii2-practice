<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<!-- banner -->
<!--Скопировали банер из файла home/index и подредактировали его. Для красивого отображения ошибок-->
<div class="banner">
    <!--    Подключаем сайдбар в главный вид-->
    <?= $this->render('//layouts/inc/sidebar') ?>

    <!--Так как левая часть контента тоже неизменна (меню продуктов)- создаем отдельный вид layouts/inc/sidebar
    и вынесем её в отдельный вид подключаемый sidebar.
    Открывающий тег <div class="banner"> переносим в шаблон grocery, вставляя перед $content-->

    <div class="w3l_banner_nav_right">
        <div style="padding: 0 1em">
            <h2><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- banner -->
