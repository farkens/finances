<?php

namespace app\controllers;

use Yii;
use app\models\Costs;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\BehaviorController;

/**
 * CostController implements the CRUD actions for Costs model.
 */
class CostController extends BehaviorController
{
    /**
     * Lists all Costs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Costs::find()->where(['userID' => \Yii::$app->user->id]),
        ]);
        $model = new Costs();

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
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'accounts' => $arrAccount
        ]);
    }
    
    public function actionAddCost() {


        $model = new Costs();
        //зполняем поле автоматически
        $model->userID = Yii::$app->user->id;
        
        if($model->load(\Yii::$app->request->post())){
            if ($model->validate()) {
                if($model->save()){
                    return $this->goBack();
                }else{
                    debug($model->errors);
                }
                
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
        $arrAccount;
        foreach ($accounts as $item){
            $arrAccount[$item['id']] = $item['name'];
        }
        
        return $this->render('addCost', [
                    'model' => $model,
                    'arrAccount' => $arrAccount,
        ]);
        
    }

    /**
     * Displays a single Costs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Costs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  /*  
    public function actionCreate()
    {
        $model = new Costs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
   * 
   */
    /**
     * Updates an existing Costs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Costs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Costs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Costs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Costs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
