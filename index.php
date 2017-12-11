<?php
session_start();

if (!isset($_SESSION["session_usuario"])) {
    header("location:Login.php");
}



require('include/conexion_bd.php');
require('include/funciones_bd.php');
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>Reporte Invernadero</title>
        <meta http-equiv="refresh" content="20">

        <!-- Codigo para evitar se guarde cache de esta pagina -->
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Last-Modified" content="0"/>
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>

        <!--Librerias de jquery---->
        <script src="js/jquery_102/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/jquery_102/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
        <script src="js/jquery_102/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery_102/jquery.blockUI.js" type="text/javascript"></script>
        <script src="js/jquery_102/jquery.validate.js" type="text/javascript"></script>
        <script src="js/jquery_102/jquery.validate.min.js" type="text/javascript"></script>
        <link href="js/jquery_102/themes/custom/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css"/>
        <link href="js/jonthornton-jquery-timepicker-e417a53/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css"/>
        <script src="js/jonthornton-jquery-timepicker-e417a53/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
        <script src="js/Highcharts-3.0.10/js/highcharts.js" type="text/javascript"></script>
        <script src="js/Highcharts-3.0.10/js/highcharts.src.js" type="text/javascript"></script>
        <script src="js/Highcharts-3.0.10/js/modules/exporting.js" type="text/javascript"></script>



        <style type="text/css">
            .TablaEncabezado {
                border: 0px #000000 solid;
                width:100%;
                height: 45px; 
                margin: 0px; 
                padding: 0px; 
                border-collapse: collapse;

            }
            #titulo{
                width:100%;
                margin-top: 0px;
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                z-index:100;
                font-size:30px;
                font-weight: bold;
                color: rgb(113, 116, 119);
            }

            #subtitulo{
                width:100%;
                margin-top: 0px;
                text-align:center;
                font-family: Arial, Helvetica, sans-serif;
                z-index:100;
                font-size:12px;
                font-weight: bold;
                color: rgb(93, 96, 99);
            }
            .botonExcel
            {
                cursor:pointer;
            }
            #header {
                margin:auto;
                width:500px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            ul, ol {
                list-style:none;
            }

            .nav {
                width:500px; /*Le establecemos un ancho*/
                margin:0 auto; /*Centramos automaticamente*/
            }

            .nav > li {
                float:left;
            }

            .nav li a {
                background-color:#989eb4;
                color:#fff;
                text-decoration:none;
                padding:10px 12px;
                display:block;
            }

            .nav li a:hover {
                background-color:#426de3;
            }

            .nav li ul {
                display:none;
                position:absolute;
                min-width:140px;
            }

            .nav li:hover > ul {
                display:block;
            }

            .nav li ul li {
                position:relative;
            }

            .nav li ul li ul {
                right:-140px;
                top:0px;
            }

            .parrafo {
                font-family: Verdana, Arial, Helvetica, sans-serif;

            }

        </style>

    </head>
    <body>

        <table class="TablaEncabezado" border="0" width="100%" >
            <tr>
                <td width="208px" rowspan="2" >
                    <img  src="img/logo uvm.png" />
                </td>
                <td valign="bottom" height="5px" >
                    <div id="titulo" >Invernadero UVM</div>
                </td>

                <td width="208px" rowspan="3" align="right"  >
                    <img src="img/logo uvm.png" />
                </td>
            </tr>


            <tr align="center" valign="top" >
                <td  bgcolor="#ffffff" height="5px"  >
                    <div id="subtitulo" >Proyecto Final Control Analogico y Electronica</div>
                </td>

            </tr>
        </table>
        <br>
        <table  width="100%" align="center">  
            <div id="header">
                <nav> 
                    <ul class="nav">
                        <li><a href="index.php">Inicio</a></li>
                        <!--li><a href="Control.php">Control</a></li-->

                        <li><a>Admin</a>
                            <ul>
                                <li><a href="consultar_usuarios.php">Consultar de Usuarios</a></li>
                                <li><a href="Editar_registro.php">Editar Usuario</a></li>
                                <li><a href="Alta_Usuarios.php">Alta de Usuarios</a></li>
                            </ul>
                        </li>
                        <li><a href="Contacto.php">Contacto</a></li>
                        <li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
                    </ul>
                </nav>
            </div>     
        </table>
    <center>
        <form action="Exportar_Excel.php" method="post" target="_blank" id="FormularioExportacion">
            <p><a></a>Exportar a Excel<img src="img/tabla.png" class="botonExcel" /></p>
            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
        </form>
    </center>
    
    <?php
// inicia la tabla
    echo "<table id='Exportar_a_Excel' border='1' cellpadding='5' align='center' style='border-collapse:collapse; border: 1px #ccc solid; font-family: helvetica;font-size: 10px;' >
             <thead>
<tr>                                         
<th width='100px' style='background-color:#090808;color:#ffffff; font-size:12px; font-weight:bold; border:1px solid #cccccc;padding:3px' >HUMEDAD</th>
<th width='100px' style='background-color:#090808;color:#ffffff; font-size:12px; font-weight:bold; border:1px solid #cccccc;padding:3px' >TEMPERATURA</th>
<th width='100px' style='background-color:#090808;color:#ffffff; font-size:12px; font-weight:bold; border:1px solid #cccccc;padding:3px' >LUMINOCIDAD</th>                                            
<th width='150px' style='background-color:#B40404;color:#ffffff; font-size:12px; font-weight:bold; border:1px solid #cccccc;padding:3px' >FECHA</th>
                                           
                                    </tr>

                            </thead>";

    $query = "SELECT humedad, temperatura,luminocidad,fecha FROM control";

    $resultado = consultarMSSQL($query);
    if (!$resultado) {
        die("Error no se puedo hacer la consulta");
    }

    while ($fila = mssql_fetch_array($resultado)) {
        
     $humedad = $fila['humedad'];
    $temperatura = $fila['temperatura'];
    $luminocidad = $fila['luminocidad'];
    $fecha = $fila['fecha'];

        $GRAFICA_HUMEDAD.= $humedad . ",";
        $GRAFICA_TEMPERATURA.= $temperatura . ",";
        $GRAFICA_FECHA.= "'" . $fecha . "',";
        $GRAFICA_LUMINOCIDAD.=  $luminocidad . ",";

        echo "<thead>";
        echo"<tr>";
        echo"<td align ='center' style=font-size:12px;>" . $humedad . " %</td>";
        echo"<td align ='center' style=font-size:12px;>" . $temperatura . " °</td>";
        echo"<td align ='center' style=font-size:12px;>" . $luminocidad . " %</td>";
        echo"<td width='100px' style='background-color:#B40404;color:#ffffff;font-size:12px; font-weight:bold; border:1px solid #cccccc;padding:3px'>" . $fecha . "</td>";
        echo"</tr>";
        echo"</thead>";
    }
    echo "</table>";

    // Sacamos el tamaño del arreglo para quitar la ultima "," y lo toma la variable $tam
    $TAM = strlen($GRAFICA_FECHA);
    $tam = strlen($GRAFICA_HUMEDAD);
    $taM = strlen($GRAFICA_TEMPERATURA);
    $tAM = strlen($GRAFICA_LUMINOCIDAD);

    //funcion para quitar la ultima "," del arreglo
    $GRAFICA_FECHA = substr($GRAFICA_FECHA, 0, $TAM - 1);
    $GRAFICA_HUMEDAD = substr($GRAFICA_HUMEDAD, 0, $tam - 1);
    $GRAFICA_TEMPERATURA = substr($GRAFICA_TEMPERATURA, 0, $taM - 1);
    $GRAFICA_LUMINOCIDAD = substr($GRAFICA_LUMINOCIDAD, 0, $tAM - 1);
    
  
    ?>
    <script type="text/javascript">
        // codigo jquery para ejecutar la exportacion a excel
        $(document).ready(function () {

            $('.botonExcel').click(function (event) {
                $('#datos_a_enviar').val($('<div>').append($('#Exportar_a_Excel').eq(0).clone()).html());
                $('#FormularioExportacion').submit();
            });

        });

        $(function () {

            Highcharts.setOptions({
                lang: {
                    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    decimalPoint: '.',
                    thousandsSep: ',',
                    contextButtonTitle: 'Exportar',
                    downloadJPEG: 'JPG',
                    downloadPDF: 'PDF',
                    downloadPNG: 'PNG',
                    downloadSVG: 'SVG',
                    loading: 'Cargando...',
                    printChart: 'Imprimir',
                    resetZoom: 'Restablecer grafico',
                    resetZoomTitle: 'Reestablecer grafico'
                }
            });

            $('#contenedor_grafica_2').highcharts({
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'INVERNADERO UVM'
                },
                subtitle: {
                    text: 'DATOS TOMADOS DEL SENSOR DHT11'
                },
                xAxis: [{
                        categories: [<?php echo "$GRAFICA_FECHA"; ?>],
                        crosshair: true,
                        labels: {
                            rotation: 90
                        }
                    }],
                yAxis: [{// Primary yAxis
                        labels: {
                            format: '{value}%',
                            style: {
                                color: Highcharts.getOptions().colors[2]
                            }
                        },
                        title: {
                            text: 'HUMEDAD',
                            style: {
                                color: Highcharts.getOptions().colors[2]
                            }
                        },
                        opposite: true

                    }, {// Secondary yAxis
                        gridLineWidth: 0,
                        title: {
                            text: 'TEMPERATURA',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: '{value} °',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        }

                    }, {// Tertiary yAxis
                        gridLineWidth: 0,
                        title: {
                            text: 'LUMINOCIDAD',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        labels: {
                            format: '{value} ',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        opposite: true
                    }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 80,
                    verticalAlign: 'top',
                    y: 55,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                series: [{
                        name: 'TEMPERATURA',
                        type: 'spline',
                        yAxis: 1,
                        data: [<?php echo "$GRAFICA_TEMPERATURA"; ?>],
                        tooltip: {
                            valueSuffix: ' °'
                        }

                    }, {
                        name: 'LUMINOCIDAD',
                        type: 'spline',
                        yAxis: 2,
                        data: [<?php echo "$GRAFICA_LUMINOCIDAD"; ?>],
                        marker: {
                            enabled: false
                        },
                        dashStyle: 'shortdot',
                        tooltip: {
                            valueSuffix: '%'
                        }

                    }, {
                        name: 'HUMEDAD',
                        type: 'spline',
                        data: [<?php echo"$GRAFICA_HUMEDAD"; ?>],
                        tooltip: {
                            valueSuffix: '%'
                        }
                    }]
            });
        });

    </script>

    <center>
        <div id="divReporte">&nbsp;</div>   
        <div id="contenedor_grafica_2" style="width:75%; height:450px; text-align:center" align="center">&nbsp;</div>
    </center>
</body>
</html>
