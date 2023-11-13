<?php

include 'xajax/xajax_core/xajax.inc.php';

$xajax = new xajax();
$xajax->configure("debug", true);

function cambiarColor($color) {
    $respuesta = new xajaxResponse();

    $colorHex = obtenerCodigoColor($color);

    $respuesta->assign('parrafoResultado', 'style.backgroundColor', $colorHex);
    $respuesta->assign('botonEnviar', 'disabled', true);
    $respuesta->assign('botonEnviar', 'value', 'NOENVIAR');

    // Nueva línea para agregar un mensaje a la respuesta
    $respuesta->alert("Color cambiado a: " . $color);

    return $respuesta;
}

function obtenerCodigoColor($color) {
    $colores = array(
        'rojo' => '#FF0000',
        'verde' => '#00FF00',
        'azul' => '#0000FF',
        'vacío' => '#FFFFFF'
    );

    return isset($colores[$color]) ? $colores[$color] : $colores['vacío'];
}

$xajax->register(XAJAX_FUNCTION, 'cambiarColor');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Interacción con xajax</title>
    <script src="xajax/xajax_js/xajax_core.js" type="text/javascript"></script>
</head>
<body>
    <!-- Resto de tu código HTML aquí -->

    <form id="miFormulario">
        <select id="colores" onchange="enviarColor()">
            <option value="">Selecciona un color</option>
            <option value="rojo">Rojo</option>
            <option value="verde">Verde</option>
            <option value="azul">Azul</option>
            <option value="vacío">Vacío</option>
        </select>
        <br>
        <input type="submit" value="Enviar" id="botonEnviar" onclick="return false;">
    </form>

    <p id="parrafoResultado">Texto de ejemplo</p>

    <script>
        function enviarColor() {
            console.log("Función enviarColor ejecutada");

            var colorSeleccionado = document.getElementById("colores").value;
            console.log("Color seleccionado: " + colorSeleccionado);

            var botonEnviar = document.getElementById("botonEnviar");

            // Desactivar el botón y cambiar su valor
            botonEnviar.disabled = true;
            botonEnviar.value = "NOENVIAR";

            // Enviar el color al servidor mediante xajax
            console.log("Enviando color al servidor: " + colorSeleccionado);

            // Aquí deberías tener xajax definido y debería funcionar
            xajax.cambiarColor(colorSeleccionado);
        }

        // Función para procesar la respuesta de xajax
        function actualizarPagina() {
            console.log("Actualizando la página");
        }

        // Registra la función en xajax para procesar la respuesta
        xajax.callback.global.onComplete = actualizarPagina;
    </script>
</body>
</html>
