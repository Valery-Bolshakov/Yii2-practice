<?php
/*ФОРМА ВИДА: РЕДАКТИРОВАНИЯ ЗАКАЗА*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>
<!--Внесем некоторые правки в форму редактирования-->
<div class="order-form">
    <!--Вносим свойства для разметки таблицы формы-->
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "
                    <div class='col-md-6'> <!--Устанавливаем ширину каждого поля в 6 колонок-->
                        <p>{label}</p> \n {input} \n
                        <div>{error}</div> <!--вывод ошибок валидации-->
                    </div>
                    ",
        ]
    ]); ?>

    <!--Убираем лишние данные которые теоретически не надо редактировать и редактируем имеющиеся-->
    <?= $form->field($model, 'status')->dropDownList([0 => 'Новый', 1 => 'Завершён']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
