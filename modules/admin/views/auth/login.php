<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!--После заполнения данных и отправки формы - они уходят постом в Auth контроллер где обрабатываются
и на основе результатов выдается подходящая страница-->
<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg">Войдите, чтобы продолжить...</p>

        <!--Используем стандартный виджет для формы ActiveForm-->
        <?php $form = ActiveForm::begin(); ?>

        <!--класс glyphicon-user в форме отвечает за иконку юзера-->
        <?= $form->field($model, 'username', ['template' => "<div class='form-group has-feedback'> 
            {input} <span class=\"glyphicon glyphicon-user form-control-feedback\"></span><div>{error}</div></div>",])
            ->textInput(['placeholder' => 'Login']) ?>

        <!--класс glyphicon-lock в форме отвечает за иконку пароля-->
        <?= $form->field($model, 'password', ['template' => "<div class='form-group has-feedback'> 
            {input} <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span><div>{error}</div></div>",])
            ->passwordInput(['placeholder' => 'Password']) ?>

        <!--Чекбокс-->
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox2">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "{label} {input}"
                    ]) ?>
                </div>
            </div>

            <!--Кнопка-->
            <div class="col-xs-4">
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary btn-block btn-flat',
                    'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
