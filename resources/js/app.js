import './bootstrap';

import $ from 'jquery';


$(".increment").on("click", function () {
    var input = $(this).parent().siblings("input[type='number']");
    var value = parseInt(input.val());
    if (value < parseInt(input.attr("max"))) {
        input.val(value + 1);
    }
    console.log("Incrementando valor a: ", input.val()); // Agrega este console.log para depurar
});

$(".decrement").on("click", function () {
    var input = $(this).parent().siblings("input[type='number']");
    var value = parseInt(input.val());
    if (value > parseInt(input.attr("min"))) {
        input.val(value - 1);
    }
    console.log("Disminuyendo valor a: ", input.val()); // Agrega este console.log para depurar
});

$(document).ready(function(){
    $('#title').focus();
    $('#text').autosize();
});
