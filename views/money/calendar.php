<?php

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

<div class="container">
    <?php
    
        //Показываем выбор года
    /*
        $curentYear = (int) date('Y');
        $countYear = $curentYear - 42;//начинаем года - (6*7)
        $calendar = '';
        for ($week = 1; $week <= 6; $week++) {
            $calendar .= "<div class = 'row'>";
            for($day = 1; $day <= 7; $day++){
                $countYear++;
                $calendar .= "<div class = 'grid-item'>" . ( ($countYear === $curentYear) ? ('<span style="color:red">' . date('Y', mktime(0, 0, 0, 1, 1, $countYear  ) ) . '</span>' ) : date('Y', mktime(0, 0, 0, 1, 1, $countYear  ) ) ) . "</div>";
            }
            $calendar .= " </div>";
        }
        echo $calendar;
     */
    ?>
    
    <?php
    
        //Вывод месяцев в году
    /*
        $curentMonth = date('F');

        $calendar = '';
        for ($row = 0; $row <= 1; $row++) {
            $calendar .= "<div class = 'row'>";
            for ($month = 1; $month <= 6; $month++) {
                $calendar .= "<div class = 'grid-item'>" .  date('F', mktime(0, 0, 0, $month + $row * 6, 1, date('Y')  ) )  . "</div>";
            }
            $calendar .= " </div>";
        }
        echo $calendar;
     */
    ?>
    
    <?php
    
        //Вывод дней
        $curentYear = (int) date('Y');//Текущий год
        $curentMonth = date('m');//текущий месяц
        $curentDay = date('d');//текущий день
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
                $calendar .= "<div class = 'grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth - 1, $beginDayBeforeMonthForGrid, $curentYear)) . "'>" .  $beginDayBeforeMonthForGrid  . $result . "</div>";
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
                $calendar .= "<div class = 'grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear)) . "'>" . ( ($countDayCurentMonth == $curentDay) ? ('<span style="color:red">' . date('d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear ) )  . '</span>' ) : date('d', mktime(0, 0, 0, $curentMonth, $countDayCurentMonth, $curentYear ) ) ) . $result . "</div>";
            }else{
                //продолжаем заполнять следующим месяцем
                //Дата этого дння в формате Y-m-d
                $curentDate = date('Y-m-d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) );
                $result_income = search_array($income, $curentDate);
                $result_cost = search_array($cost, $curentDate, true);
                $result = "<ul class='sortable'>" . $result_income . $result_cost . '</ul>';
                $calendar .= "<div class = 'grid-item' date='" . date('Y-m-d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) ) . "'>" . date('d', mktime(0, 0, 0, $curentMonth + 1, ($countDayCurentMonth - $countDayThisMonth), $curentYear ) ) . $result  . "</div>";
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
        
        function search_array($array, $value, $cost = false){
            $content = '';
            for($i = 0; $i <= count($array) - 1; $i++){
                if(array_search($value, $array[$i])){                   
                    $content .= "<li class='sortable_item " . ($cost ? 'sortable_item-cost': 'sortable_item-income') . "' id='{$array[$i]['id']}'" . ($cost ? 'cost="1"' : null) . ">{$array[$i]['name']}<div>{$array[$i]['sum']}</div></li>";
                }
            }
            return $content;
        } 
    ?>
    
    <div id="result"></div>
    
</div>