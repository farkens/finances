<?php

namespace app\controllers;

use Yii;
use app\models\RegForm;
use app\models\LoginForm;
use app\models\User;


class MainController extends \yii\base\Controller {

    public function actionReg() {
        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->reg()) {
                if ($user->status === User::STATUS_ACTIVE) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
        }
        return $this->render('reg', compact('model'));
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/main/index']);
    }

    public function actionLogin() {
        $model = new LoginForm();
        if (!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;

        if ($model->load(Yii::$app->request->post()) && $model->login()):
            return $this->goBack();
        endif;
        return $this->render(
                        'login', [
                    'model' => $model
                        ]
        );
    }

}
