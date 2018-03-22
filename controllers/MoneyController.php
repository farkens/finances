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
        return $this->render('addIncome', [
                    'model' => $model,
                    'accounts' => $accounts,
        ]);
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
        $searchModel = new \app\models\IncomeSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('income', compact('income', 'model', 'accounts', 'searchModel', 'dataProvider'));
    }
    
    //Редактировать
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function beforeAction($action) {
        if($action->id == 'edit'){
            $this->enableCsrfValidation = FALSE;
        }
        return parent::beforeAction($action);
    }

    
    //Редактировать
    public function actionEdit()
    {
        if(\Yii::$app->request->isAjax){
            $model = \app\models\Income::findOne(\Yii::$app->request->post('id'));
            $model->date = \Yii::$app->request->post('date');
            if($model->save()){
                 return 'отредактированно';
            }
        }
       
    }
    
    //Календарь
    public function actionCalendar() {
        $income = \app\models\Income::find()
                ->select(['id', 'name', 'comment', 'sum', 'date'])
                ->where(['userID' => \Yii::$app->user->id])
                ->asArray()
                ->all();

        
        return $this->render('calendar', compact('income'));
    }
    
    //Удаление
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\Income::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
