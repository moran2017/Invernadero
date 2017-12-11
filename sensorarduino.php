<html>
    <head>
        <title>sensor_arduino</title>
    </head>
    <body>
        <?php
        require('include/conexion_bd.php');
        require('include/funciones_bd.php');
// Parametros para encender leds

        date_default_timezone_set('America/Mexico_City');

        $fecha = date_default_timezone_get();

        //$fecha = $_GET["fecha"];
        $temperatura = $_GET["temperatura"];
        $humedad = $_GET["humedad"];
        $luminosidad = $_GET["luminosidad"];


// Valida que esten presente todos los parametros
        if (( $temperatura != "") and ( $humedad != "") and ( $luminosidad != "")) {

            $query1 = "INSERT INTO control(fecha,temperatura,humedad,luminocidad) VALUES (NOW(),'" . $temperatura . "','" . $humedad . "','" . $luminosidad . "')";
            $resultadoConsulta1 = insertarMYSQL($query1);
            if (!$resultadoConsulta1) {
                die("Error no se pudo insertar los valores2");
            }
        }
        // Genera respuesta en XML para que el Arduino lo procese
        if ($temperatura > 21) {
            echo "<led_1>1</led_1>";
        } else {
            echo "<led_1>0</led_1>";
        }
        if ($humedad < 44) {
            echo "<led_2>1</led_2>";
        } else {
            echo "<led_2>0</led_2>";
        }
        if ($luminosidad < 300) {
            echo "<led_3>1</led_3>";
        } else {
            echo "<led_3>0</led_3>";
            echo "\n";
        }
        ?>
    </body>
</html>