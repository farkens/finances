<?php

namespace app\controllers;

class UserController extends \yii\web\Controller
{
    public function actionSettings()
    {
        return $this->render('settings');
    }

}
