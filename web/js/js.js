$(document).ready(function () {

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 5000,
        values: [75, 300],
        slide: function (event, ui) {
            $("#amount_begin").val(ui.values[ 0 ]);
            $("#amount_end").val(ui.values[ 1 ]);
        }
    });
    //$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
    //  " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    


});


