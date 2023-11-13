<?php
include 'xajax/xajax_core/xajax.inc.php';

$xajax = new xajax();
$xajax->configure('debug', true);
$xajax->configure('javascript URI', 'xajax/xajax_js/');

function cambiarColor($color) {
    $respuesta = new xajaxResponse();

    if ($color != 'vacío') {
        $colorHex = obtenerCodigoColor($color);
        $respuesta->assign('parrafoResultado', 'style.backgroundColor', $colorHex);
        $respuesta->assign('botonEnviar', 'disabled', true);
        $respuesta->assign('botonEnviar', 'value', 'NOENVIAR');
    } else {
        // Si se selecciona "vacío", restaurar valores
        $respuesta->assign('parrafoResultado', 'style.backgroundColor', '#FFFFFF'); // Fondo blanco
        $respuesta->assign('botonEnviar', 'disabled', false); // Habilitar el botón
        $respuesta->assign('botonEnviar', 'value', 'Enviar'); // Restaurar el valor del botón
    }

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
    <form id="miFormulario">
        <select id="colores">
            <option value="">Selecciona un color</option>
            <option value="rojo">Rojo</option>
            <option value="verde">Verde</option>
            <option value="azul">Azul</option>
            <option value="vacío">Vacío</option>
        </select>
        <br>
        <input type="button" value="Enviar" id="botonEnviar" onclick="enviarColor()">
    </form>

    <p id="parrafoResultado">Texto de ejemplo</p>

    <script>
        function enviarColor() {
            var colorSeleccionado = document.getElementById("colores").value;

            // Llamada a la función xajax.request
            xajax.request({
                xjxfun: 'cambiarColor',
                parameters: [colorSeleccionado],
                error: function () {
                    alert('Error al ejecutar xajax.cambiarColor');
                }
            });
        }
    </script>
</body>

</html>
