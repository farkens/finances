<?php

namespace app\controllers;

class MoneyController extends MainController
{
    public function actionIndex()
    {
        
        $accountGroup = \app\models\AccountGroup::find()
                ->with('account')
                ->all();
        
        
        return $this->render('index', compact('accountGroup') );
    }
    
    //
    public function actionAddAccount() {
        
    }
    
    //Прибыль
    public function actionIncome(){
        $income = \app\models\Income::find()
                ->where(['userID' => \Yii::$app->user->id])
                ->all();
        return $this->render('income', compact('income'));
    }

}
