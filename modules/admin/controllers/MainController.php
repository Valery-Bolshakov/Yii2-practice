<?php


namespace app\modules\admin\controllers;


class MainController extends AppAdminController
{
    /*Контроллер для Главной страницы Админской панели*/
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        return $this->render('test');
    }

}