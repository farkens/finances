<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->registerJs(
        '$("document").ready(function(){
            
            $(".sortable").sortable({
                connectWith: ".sortable",
                placeholder: "placeholder",
                //Происходит при завершении перемещения элемента пользователем при условии, что порядок элементов был изменен
                update: function (e, ui) {
                    var id = ui.item.attr("id");//ID перемещаеммого объекта
                    var date = $(this).parents(".grid-item").attr("date");//дата родителя куда перенесли
                    var cost = ui.item.attr("cost");//переменная для определения расходов
                    $.ajax({
                        url: "index.php?r=money%2Fedit",
                        type:"post",
                        data: { "id":id, "date":date, "cost":cost },
                        success: function( data ) {
                            $("#result").html("Send JSON to the server:<pre>" + data + "</pre>");
                        },
                        error: function () {

                        }
                    });

                },
            });
        });'
);



?>

<?php

        $form = ActiveForm::begin([
        'id' => 'calendar',
        'options' => ['class' => 'calendar-form-horizontal'],
        'method' => 'get',
    ]) ?>
        <?php //доделать листание дат годов когда мы находимся в выборе года! ?>
        <?= "<a href='" . yii\helpers\Url::toRoute(['', 'show' => ( ($show == 'year') ? $show : ''), 'year' => $curentYear - ( ($show == 'year') ? 18 : 1), 'month' => $curentMonth]) . "'><</a>" ?>
        <?= Html::submitButton($curentYear, ['name' => 'show', 'value' => 'year']) ?>
        <?= "<a href='" . yii\helpers\Url::toRoute(['', 'show' => ( ($show == 'year') ? $show : ''), 'year' => $curentYear + ( ($show == 'year') ? 24 : 1), 'month' => $curentMonth]) . "'>></a>" ?>
        <?= "<a href='" . yii\helpers\Url::toRoute(['', 'show' => '', 'year' => $curentYear, 'month' => $curentMonth - 1]) . "'><</a>" ?>
        <?= Html::submitButton(date('F', mktime(0, 0, 0, $curentMonth, 1, $curentYear )), ['name' => 'show', 'value' => 'month']) ?>
        <?= "<a href='" . yii\helpers\Url::toRoute(['', 'show' => '', 'year' => $curentYear, 'month' => $curentMonth + 1]) . "'>></a>" ?>
        <?= "<a href='" . yii\helpers\Url::toRoute(['', 'show' => '', 'year' => '', 'month' => '']) . "'>Сегодня</a>" ?>
    
    <?php
        ActiveForm::end();
    ?>

<div class="container">
    
    
    
    <?php
    if(Yii::$app->request->get('show') == 'year'){
        //Показываем выбор года

        //$countYear = $curentYear - 42;//начинаем года - (6*7)
        $countYear = $curentYear - 18;//начинаем года - (6*7)
        $calendar = '';
        for ($week = 1; $week <= 6; $week++) {
            $calendar .= "<div class = 'flex-container'>";
            for($day = 1; $day <= 7; $day++){
                $countYear++;
                $link = "<a href='" . yii\helpers\Url::toRoute(['', 'show' => '', 'year' => $countYear, 'month' => (Yii::$app->request->get('month') ? Yii::$app->request->get('month') : '1')]) . "'>" . date('Y', mktime(0, 0, 0, 1, 1, $countYear  ) ) . "</a>";
                $calendar .= "<div class = 'grid-item'>" . ( ($countYear === $curentYear) ? ('<span style="color:red">' . $link . '</span>' ) : $link ) . "</div>";
            }
            $calendar .= " </div>";
        }
        echo $calendar;
     
    
    }elseif(Yii::$app->request->get('show') == 'month'){
        //Вывод месяцев в году

        $calendar = '';
        for ($row = 0; $row <= 1; $row++) {
            $calendar .= "<div class = 'flex-container'>";
            for ($month = 1; $month <= 6; $month++) {
                $link = "<a href='" . yii\helpers\Url::toRoute(['', 'show' => '', 'month' => date('m', mktime(0, 0, 0, $month + $row * 6, 1, date('Y') ) ), 'year' => (Yii::$app->request->get('year') ? Yii::$app->request->get('year') : date('Y')) ]) . "'>" . date('F', mktime(0, 0, 0, $month + $row * 6, 1, date('Y')  ) )  . "</a>";
                $calendar .= "<div class = 'grid-item'>" . $link . "</div>";
            }
            $calendar .= " </div>";
        }
        echo $calendar;
    }else{
        //Вывод дней
        $tooday = date('Y-m-d');
        //($curentYear ? $curentYear : $curentYear = (int) date('Y')); //Текущий год
        //($curentMonth ? $curentMonth : $curentMonth = date('m')); //текущий месяц
        $curentYear = $curentYear; //Текущий год
        $curentMonth = $curentMonth; //текущий месяц
        //день недели 1 числа текущего месяца. - 2
        $weekdayFierstWeek = date('N', mktime(0, 0, 0, $curentMonth, 1, $curentYear)) - 2;
        //Число дней в прошлом месяце
        $countDayBeforeMonth = date('t', mktime(0, 0, 0, ($curentMonth - 1) , 1, $curentYear));
        //Число дней в текущем месяце
        $countDayThisMonth = date('t', mktime(0, 0, 0, $curentMonth , 1, $curentYear));
        
        //начальный день прошлого месяца для текущей сеьтки
        $beginDayBeforeMonthForGrid = $countDayBeforeMonth - $weekdayFierstWeek;

        $grid = -42;//сетка для вывода всего календаря
        $calendar = "";//конкатинируем календарь для вывода
        $day = 0;//сщетчик для перехода после 7 дней на новую строку
        $countDayCurentMonth = 1;//дни текущего месяца
        $weekDayGreed = "<div class='flex-container week_day'>";
        $weekDayGreed .= "<div class='grid-item'>Пн</div>";
        $weekDayGreed .= "<div class='grid-item'>Вт</div>";
        $weekDayGreed .= "<div class='grid-item'>Ср</div>";
        $weekDayGreed .= "<div class='grid-item'>Чт</div>";
        $weekDayGreed .= "<div class='grid-item'>Пт</div>";
        $weekDayGreed .= "<div class='grid-item'>Сб</div>";
        $weekDayGreed .= "<div class='grid-item'>Вс</div>";
        $weekDayGreed .= "</div>";
        echo $weekDayGreed;
        
        while ($grid < 0) {
            if($day == 0){
                $calendar .= "<div class = 'flex-container'>";
            }
            
            while ($weekdayFierstWeek >= 0 ){
                //вывести остатки дней за прошлый месяц
                //Дата этого дння в формате Y-m-d
                $curentDate = date('Y-m-d', mktime(0, 0, 0, $curentMonth - 1, $beginDayBeforeMonthForGrid, $curentYear));
                $result_income = search_array($income, $curentDate );
                $result_cost = search_array($cost, $curentDate, true);
                $result = "<ul class='sortable'>" . $result_income . $result_cost . '</ul>';
                $calendar .= "<div class='grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth - 1, $beginDayBeforeMonthForGrid, $curentYear)) . "'>" . ( ($tooday == $curentDate) ? ('<span style="color:red">' . $beginDayBeforeMonthForGrid . '</span>' ) : $beginDayBeforeMonthForGrid ) . $result . "</div>";
                $beginDayBeforeMonthForGrid++;
                $weekdayFierstWeek--;
                $day++;
                $grid++;
            }
            //выводим текущий месяц
            if($countDayCurentMonth <= $countDayThisMonth ){
                //Дата этого дння в формате Y-m-d
                $curentDate = date('Y-m-d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear));
                $result_income = search_array($income, $curentDate);
                $result_cost = search_array($cost, $curentDate, true);
                $result = "<ul class='sortable'>" . $result_income . $result_cost . '</ul>';
                $calendar .= "<div class='grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear)) . "'>" . ( ($tooday == $curentDate) ? ('<span style="color:red">' . date('d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear ) ) . '</span>' ) : date('d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear ) ) ) . $result . "</div>";
            }else{
                //продолжаем заполнять следующим месяцем
                //Дата этого дння в формате Y-m-d
                $curentDate = date('Y-m-d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) );
                $result_income = search_array($income, $curentDate);
                $result_cost = search_array($cost, $curentDate, true);
                $result = "<ul class='sortable'>" . $result_income . $result_cost . '</ul>';
                $calendar .= "<div class='grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) ) . "'>" . ( ($tooday == $curentDate) ? ('<span style="color:red">' . date('d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) ) . '</span>' ) : date('d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) ) )  . $result  . "</div>";
            }
            $countDayCurentMonth++;
            $grid++;
            $day++;
            
            if($day == 7){
                $calendar .= " </div>";
                $day = 0;
            }
            
            
        }
        echo $calendar;
        //$result = search_array($income, '2018-02-21');
        
         
    }
    ?>

    
    <div id="result"></div>
    
</div>