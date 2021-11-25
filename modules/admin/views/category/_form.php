<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <? //= $form->field($model, 'parent_id')->textInput() // вместо этого подставим ниже тайтла всплываюший список?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!--копируем разметку для всплываюшего списка со страницы "Редактирование заказа"-->
    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Родительская категория</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]">
            <option value="0">Самостоятельная категория</option>
            <!--Далее вызываем меню виджет который будет генерировать остальные варианты опций-->
            <?= \app\components\MenuWidget::widget([
                /*в свойство tpl указали шаблон select, далее необходимо создать данный шаблон. Создаем его
                в разделе components/menu_tpl */
                'tpl' => 'select',
                /*добавим в MenuWidget некоторые свойства которые нам понадобятся: */
                'model' => $model,
                'cache_time' => 0,  // установим тайминг кеша в 0 что бы в админке меню не кешировалось.
            ]) ?>
        </select>
        <div>
            <div class="help-block"></div> <!--вывод ошибок валидации-->
        </div>
    </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
