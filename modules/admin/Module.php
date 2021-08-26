<?php

namespace app\modules\admin;

use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


    /*Фильтры контроля доступа. Переносим данное поведение behaviors из AppAdminController
    в Module, что бы избежать конфликтов*/
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
