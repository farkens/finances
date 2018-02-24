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
        return $this->render('income');
    }

}
