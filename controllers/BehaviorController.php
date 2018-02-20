<?php

namespace app\controllers;

use yii\filters\AccessControl;

class BehaviorController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['main'],
                        'actions' => ['login', 'reg'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['main'],
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['money'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

}
