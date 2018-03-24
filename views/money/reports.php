<?php
$this->registerJs(
        "$('document').ready(function(){
            
            var ctx = document.getElementById('myChart');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                            label: 'Прибыль',
                            backgroundColor: 'green',
                            borderColor: 'green',
                            data: [
                                123,
                                123,
                                157,
                                312,
                                123,
                                321,
                                168
                            ],
                            fill: false,
                        }, {
                            label: 'Затраты',
                            fill: false,
                            backgroundColor: 'red',
                            borderColor: 'red',
                            data: [
                                113,
                                123,
                                197,
                                212,
                                123,
                                321,
                                138
                            ],
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