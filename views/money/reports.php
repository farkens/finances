<?php
$this->registerJs(
        "$('document').ready(function(){
            
            var income_year = [];
        
                $.ajax({
                    url: '/money/year',
                    type:'get',
                    dataType : 'json',
                    data: { 'id':'year', 'year': 2018 },
                    success: function( data ) {
                        //$('#result').html('Send JSON to the server:<pre>' + data + '</pre>');
                        show_chart_year(data);
                    },
                    error: function (exception) {
                        alert(exception);
                    }
                });
                    
            function  show_chart_year(income_year){
                var income = [];
                var cost = [];
                var month = [];
                    $.each(income_year,function(key,data) {
                        month.push(key);
                        //запись прибыли
                            if($.isNumeric(data[0])){
                                cost.push(data[0]);

                            }else{
                                cost.push(data[0]['sum']);
                            }
                        //запись расходов
                        if($.isNumeric(data[1])){
                            income.push(data[1]);

                        }else{
                            income.push(data[1]['sum']);
                        }                  
                    });
                    console.log(income);
                    console.log(cost);
                    console.log(month);

                var ctx = document.getElementById('myChart');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: month,
                        datasets: [{
                                label: 'Прибыль',
                                backgroundColor: 'green',
                                borderColor: 'green',
                                data: income,
                                fill: false,
                            }, {
                                label: 'Затраты',
                                fill: false,
                                backgroundColor: 'red',
                                borderColor: 'red',
                                data: cost,
                            }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Финиансы за год'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Month'
                                    }
                                }],
                            yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Value'
                                    }
                                }]
                        }
                    }
                });

            }

            
        });"
);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <canvas id="myChart" ></canvas>
        </div>
        <div class="col-md-6 col-sm-12"></div>
    </div>

</div>