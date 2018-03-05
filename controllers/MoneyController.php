<?php

namespace app\controllers;

class MoneyController extends MainController {

    public function actionIndex() {

        $accountGroup = \app\models\AccountGroup::find()
                ->with('account')
                ->all();


        return $this->render('index', compact('accountGroup'));
    }

    //
    public function actionAddIncome() {


        $model = new \app\models\Income();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->goBack();
            } else {
                // validation failed: $errors is an array containing error messages
                debug($model->errors);
            }
        }
        //Достать все счета для выбора в форме добавления
        $accounts = \app\models\account::find()
                ->select(['id', 'name'])
                ->where(['userID' => \Yii::$app->user->id])
                ->asArray()
                ->all();
            
        return $this->render('addIncome', compact('model', 'accounts'));
    }

        //Прибыль
        public function actionIncome() {
            
            $model = new \app\models\Income();
            //Достать все счета для выбора в форме добавления
            $accounts = \app\models\account::find()
                    ->select(['id', 'name'])
                    ->where(['userID' => \Yii::$app->user->id])
                    ->asArray()
                    ->all();
            
            $income = \app\models\Income::find()
                    ->where(['userID' => \Yii::$app->user->id])
                    ->all();
            return $this->render('income', compact('income', 'model', 'accounts'));
        }

    }
    