<?php


namespace app\modules\admin\controllers;


use app\models\LoginForm;
use Yii;
use yii\base\BaseObject;

class AuthController extends AppAdminController
{
    /** Создали контроллер для странички Авторизации */

    /*Задаем шаблон для всего контроллера AuthController
        свойство $layout можно переопределить где угодно*/
    public $layout = 'auth';

    /*Создаем экшен для формы Авторизации на сайте. Данный экшен будет связан с моделью LoginForm и видом login*/
    public function actionLogin()
    {
        /*Экшен проверяет Если пользователь уже авторизован -
        его перенаправляет на главную страницу*/
        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
            /*если пользователь зарегался не как гость то редиректим на админа*/
            return $this->redirect('/admin');
        }
        /*Если не авторизован - его направляет на данную модель
            Данная модель передает форму авторизации*/
        $model = new LoginForm();

            /*После заполнения и отправки формы в виде login эти данные призодят сюда для обработки.
        Получаем данные постом, заполняем модель получеными данными, и вызываем метод логин(валидирует данные).
        Если оба результата вернули True то пользователь получает доступ к админке*/
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
            /*Если все прошло збс то так же редиректим на админа*/
            return $this->redirect('/admin');

        }

        /*Очищается атрибут модели с паролем, что бы в форме пароль был пуст*/
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /*Метод что бы выходить из админки(вводим адрес "admin/auth/logout" и выйдет из админки на авторизацию)*/
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/admin');

//        return $this->goHome();
    }


}