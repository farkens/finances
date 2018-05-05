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


        $model = new \app\models\Finance();
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
    public function actionFinance() {

        $model = new \app\models\Finance();

        //Достать все счета для выбора в форме добавления
        $accounts = \app\models\account::find()
                ->select(['id', 'name'])
                ->where(['userID' => \Yii::$app->user->id])
                ->asArray()
                ->all();
        
        //массив всех счатов пользователя
            $arrAccount;
            foreach ($accounts as $item) {
                $arrAccount[$item['id']] = $item['name'];
            }

        $income = \app\models\Finance::find()
                ->where(['userID' => \Yii::$app->user->id])
                ->all();
        //тут проблема с выборкой
        
        $searchModel = new \app\models\IncomeSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('finance', compact('income', 'model', 'arrAccount', 'searchModel', 'dataProvider'));
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
    //отменяем CSRF у экшена edit
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
            if(\Yii::$app->request->post('cost')){
                $model = \app\models\Costs::findOne(\Yii::$app->request->post('id'));
                $model->date = \Yii::$app->request->post('date');
                if($model->save()){
                     return 'отредактированна таблица расходов';
                }else{
                    return 'некая ошибка';
                }
            }else{
                $model = \app\models\Finance::findOne(\Yii::$app->request->post('id'));
                $model->date = \Yii::$app->request->post('date');
                if($model->save()){
                     return 'отредактированна таблица прибыли';
                }else{
                    return 'некая ошибка';
                }
            }
            
        }
       
    }
    
    public function actionReports() {

        return $this->render('reports');
    }
    
    //Календарь
    public function actionCalendar() {
        $income = \app\models\Finance::find()
                ->select(['id', 'name', 'comment', 'sum', 'date'])
                ->where(['userID' => \Yii::$app->user->id])
                ->asArray()
                ->all();
        $cost = \app\models\Costs::find()
                ->select(['id', 'name', 'comment', 'sum', 'date'])
                ->where(['userID' => \Yii::$app->user->id])
                ->asArray()
                ->all();
        //добавить проверку на ввод пользователя других значений
        (\Yii::$app->request->get('year') ? $curentYear = \Yii::$app->request->get('year') : $curentYear = (int) date('Y') );
        (\Yii::$app->request->get('month') ? $curentMonth = \Yii::$app->request->get('month') : $curentMonth = (int) date('m') );
        (\Yii::$app->request->get('show') ? $show = \Yii::$app->request->get('show') : $show = '' );
        return $this->render('calendar', compact('income', 'cost', 'curentYear', 'curentMonth', 'show'));
    }
    /*=============================Вывод графиков===================================*/
    //за год
    public function actionYear() {
        if(\Yii::$app->request->isAjax){
            if( \Yii::$app->request->get('id') === 'year'){
                //SELECT date_format(date, "%Y-%m"), sum(`sum`) FROM `finance` WHERE userID = '1' GROUP BY date_format(date, "%Y-%m")
                ( checkdate(1, 1, \Yii::$app->request->get('year')) ? $year = \Yii::$app->request->get('year') : $year = date('Y'));
                $data = \app\models\Finance::find()
                            ->select(['DATE_FORMAT(date, "%Y-%m")  as mydate','SUM(sum) as sum' ])
                            ->where(['userID' => \Yii::$app->user->id])
                            ->andWhere(['YEAR(`date`)' => $year])
                            ->groupBy('mydate')
                            ->indexBy('mydate')
                            ->asArray()
                            ->all();
                $costs = \app\models\Costs::find()
                            ->select(['DATE_FORMAT(date, "%Y-%m")  as mydate','SUM(sum) as sum' ])
                            ->where(['userID' => \Yii::$app->user->id])
                            ->andWhere(['YEAR(`date`)' => $year])
                            ->groupBy('mydate')
                            ->indexBy('mydate')
                            ->asArray()
                            ->all();
                return json_encode($this->groupeArray($data, $costs));
            }else{
                return FALSE;
            }
        }   

    }
    
    
    //$arr1 - массив с прибылью ; $arr2 - массив с расходами 
    protected function groupeArray($arr1, $arr2){
        //перебираем массив с прибылью и записываем в массив с расходами
        foreach ($arr1 as $k => $val){
            if(array_key_exists($k, $arr2) ){
                $arr2[$k] =  [$arr2[$k], $val];
            }else{
                //если нету такой даты
                $arr2[$k] =  [0, $val];
            }
        }
        
        //находим ключи которых нету 
        $diff_arr = array_diff_key($arr2, $arr1);
        foreach ($diff_arr as $k => $val){
            $arr2[$k] =  [$val, 0];
        }
        ksort($arr2);
        return $arr2;
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
        if (($model = \app\models\Finance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
