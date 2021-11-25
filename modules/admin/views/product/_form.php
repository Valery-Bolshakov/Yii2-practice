<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

use kartik\file\FileInput;


mihaildev\elfinder\Assets::noConflict($this);


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <? //= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!--копируем разметку для всплываюшего списка со страницы "Редактирование заказа"-->
    <div class="form-group field-product-category_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <!--Далее вызываем меню виджет который будет генерировать остальные варианты опций-->
            <?= \app\components\MenuWidget::widget([
                /*в свойство tpl указали шаблон select, далее необходимо создать данный шаблон. Создаем его
                в разделе components/menu_tpl */
                'tpl' => 'select_product',
                /*добавим в MenuWidget некоторые свойства которые нам понадобятся: */
                'model' => $model,
                'cache_time' => 0,  // установим тайминг кеша в 0 что бы в админке меню не кешировалось.
            ]) ?>
        </select>
        <div>
            <div class="help-block"></div> <!--вывод ошибок валидации-->
        </div>
    </div>

    <? //= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?php
    /* Используем визуальный редактор для поля контента (github.com/MihailDev/yii2-ckeditor)

    CKEditor Расширение для Yii 2
    CKEditor — свободный WYSIWYG-редактор, который может быть использован на веб-страницах.

    Использование c ActiveForm. Немного подредактируем под наш проект
    меняем $post на нашу модель $model */
    /*echo $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => [
            // разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'preset' => 'full',
            'inline' => false, //по умолчанию false
        ],
    ]);*/
    ?>

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [/* Some CKEditor Options */]),
    ]);
    ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
    <?php
    /*Реализуем загрузку картинок с помощью виджета kartik-v/yii2-widget-fileinput*/
    // Usage with ActiveForm and model
    /*в атрибуте пишем file и дописываем это свойство в модели Product*/
    echo $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]);
    ?>

    <?= $form->field($model, 'is_offer')->dropDownList(['Нет', 'Да']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
