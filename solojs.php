<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Interacción sin xajax</title>
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
            var parrafoResultado = document.getElementById("parrafoResultado");

            // Si el color seleccionado no es "vacío", cambiar el color del párrafo
            if (colorSeleccionado !== 'vacío') {
                parrafoResultado.style.backgroundColor = obtenerCodigoColor(colorSeleccionado);

                // Aquí puedes realizar cualquier acción adicional al enviar el color al servidor
                alert("Color enviado al servidor");
            } else {
                // Si se selecciona "vacío", restaurar valores
                parrafoResultado.style.backgroundColor = '#FFFFFF'; // Fondo blanco
            }
        }

        function obtenerCodigoColor(color) {
            var colores = {
                'rojo': '#FF0000',
                'verde': '#00FF00',
                'azul': '#0000FF',
                'vacío': '#FFFFFF'
            };

            return colores[color] || colores['vacío'];
        }
    </script>
</body>

</html>

