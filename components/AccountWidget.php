<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class AccountWidget extends Widget
{
    //сортировка по указанной дате из настроек пользоваателя
    public $date;

    public function init()
    {
        parent::init();
        if($this->date === null){
            //по умолчанию задаем за текущий месяц
            $this->date = [
                'begin' => date("Y-m-d", mktime(0, 0, 0, date('m'), 1, date("Y"))),
                'end' => date("Y-m-d", mktime(0, 0, 0, date('m'), date("t"), date("Y")))
            ];
        }
    }

    public function run()
    {
        $accountGroup = \app\models\AccountGroup::find()
                ->with('account')
                ->all();
        
        
        //Считаем сумму прибыли за указанный период времени
        $incomeSum = \app\models\Income::find()
                ->select(['SUM(sum) AS sum'])
                ->where(['userID' => \Yii::$app->user->id])
                ->andWhere(['between', 'date', $this->date['begin'], $this->date['end']])
                ->asArray()
                ->all();
        //форматируем полученную прибыль
        $income = money_format('%.2n', $incomeSum[0]['sum']);
        
        //Считаем сумму расходов за указанный период времени
        $costSum = \app\models\Costs::find()
                ->select(['SUM(sum) AS sum'])
                ->where(['userID' => \Yii::$app->user->id])
                ->andWhere(['between', 'date', $this->date['begin'], $this->date['end']])
                ->asArray()
                ->all();
        //форматируем полученную прибыль
        $cost = money_format('%.2n', $costSum[0]['sum']);
        
        return $this->render('account', compact('accountGroup', 'income', 'cost'));
    }
}