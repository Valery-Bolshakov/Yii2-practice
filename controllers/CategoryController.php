<?php


namespace app\controllers;


class CategoryController extends HomeController
{
    public function actionView()
    {
        return $this->render('view');
    }

}