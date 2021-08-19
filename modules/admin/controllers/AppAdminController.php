<?php


namespace app\modules\admin\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

class AppAdminController extends Controller
{
    /** Создали общий контроллер, для всех контроллеров Админской части приложения */

    /*Фильтры контроля доступа*/
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                /*'only' => ['login', 'logout', 'signup'],*/
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login',/* 'signup'*/],
                        /* '?' соответствует гостевому пользователю (не аутентифицирован),*/
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        /*'actions' => ['logout'], если закоментить то разрешен полный доступ*/
                        /* '@' соответствует аутентифицированному пользователю.*/
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

}