import './bootstrap';

import $ from 'jquery';


import 'jquery';

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


$(document).ready(function () {
    $(".increment-pasos").on("click", function () {
        var input = $(this).parent().siblings("input[type='number']");
        var value = parseInt(input.val());
        var max = parseInt(input.attr("max")) || Infinity; // Obtener el valor máximo, si no está definido, se utiliza Infinity como valor por defecto

        if (value < max) {
            // Incrementar los pasos en 500
            input.val(value + 500);
        }
    });

    $(".decrement-pasos").on("click", function () {
        var input = $(this).parent().siblings("input[type='number']");
        var value = parseInt(input.val());
        var min = parseInt(input.attr("min")) || -Infinity; // Obtener el valor mínimo, si no está definido, se utiliza -Infinity como valor por defecto

        if (value > min) {
            // Disminuir los pasos en 500
            input.val(value - 500);
        }
    });

    $(".increment-agua, .increment-temperatura").on("click", function () {
        var input = $(this).parent().siblings("input[type='number']");
        var value = parseFloat(input.val());
        var step = parseFloat(input.attr("step")) || 0.1; // Obtener el paso, si no está definido, se utiliza 0.1 como valor por defecto
        var max = parseFloat(input.attr("max")) || Infinity; // Obtener el valor máximo, si no está definido, se utiliza Infinity como valor por defecto

        if (value < max) {
            // Añadir el paso al valor actual
            input.val((value + step).toFixed(1)); // Redondear a un decimal
        }
    });

    $(".decrement-agua, .decrement-temperatura").on("click", function () {
        var input = $(this).parent().siblings("input[type='number']");
        var value = parseFloat(input.val());
        var step = parseFloat(input.attr("step")) || 0.1; // Obtener el paso, si no está definido, se utiliza 0.1 como valor por defecto
        var min = parseFloat(input.attr("min")) || -Infinity; // Obtener el valor mínimo, si no está definido, se utiliza -Infinity como valor por defecto

        if (value > min) {
            // Restar el paso al valor actual
            input.val((value - step).toFixed(1)); // Redondear a un decimal
        }
    });
});

$(document).ready(function () {
    $('#title').focus();
    $('#text').autosize();
});

$(document).ready(function () {
    // Mostrar el modal cuando se hace clic en la imagen de perfil
    $('#perfil-img').click(function () {
        $('#perfilModal').modal('show');
    });
});

$(document).ready(function () {
    // Agregar evento de mostrado del modal
    $('#perfilModal').on('shown.bs.modal', function () {
        // Manejar el clic en las imágenes dentro del modal
        $('#perfilModal .carousel-item img').click(function () {
            // Obtener la ruta de la imagen
            var rutaImagen = $(this).attr('src');

            // Mostrar un aviso en pantalla
            alert("¡Has seleccionado esta imagen como tu avatar!");

            // Preguntar al usuario si está seguro
            if (confirm("¿Estás seguro de seleccionar esta imagen como tu avatar?")) {
                // Extraer el nombre de la imagen de la ruta
                var nombreImagen = rutaImagen.substring(rutaImagen.lastIndexOf('/') + 1);

                // Establecer el valor del campo oculto con el nombre de la imagen
                $('#avatarSeleccionado').val(nombreImagen);

                // Enviar el formulario de avatar
                $('#avatar').submit();
            }
        });
    });
});

