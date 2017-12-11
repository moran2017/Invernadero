<?php
session_start();

  if (!isset($_SESSION["session_usuario"])) {
  header("location:Login.php");
  } else {

  }

 
//INCLUIMOS LAS FUNCIONES NECESARIAS
require('include/conexion_bd.php');
require('include/funciones_bd.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Consultas Usuarios</title>

        <!-- Codigo para evitar se guarde cache de esta pagina -->

        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Last-Modified" content="0"/>
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>

        <style type="text/css">

            #header {
                margin:auto;
                width:500px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
            }

            ul, li {
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
        <br><br><br>
    <center>

        <?php
        echo "<table border='1' cellpadding='5' align='center' style='border-collapse:collapse; border: 1px #ccc solid; font-family: helvetica;font-size: 12px;' >";

        echo"<tr>";
        echo"<th>NOMBRE</th>";
        echo"<th>USUARIO</th>";
        echo"<th>E-MAIL</th>";
        echo"<th>EDITAR</th>";
        echo"<th>ELIMINAR</th>";
        echo"</tr>";

        $query = "SELECT * FROM login";

        $resultadoConsulta = consultarMSSQL($query);

        if (!$resultadoConsulta) {
            die("Error no se pudo hace la consulta");
        }

        while ($fila = mssql_fetch_array($resultadoConsulta)) {

            $id = $fila['id'];
            $full_name = utf8_encode($fila['full_name']);
            $usuario = utf8_encode($fila['usuario']);
            $email = utf8_encode($fila['email']);


            echo "<tr>";

            echo"<td>$full_name</td>";
            echo"<td>$usuario</td>";
            echo"<td>$email</td>";
            echo"<td><a href='Editar_registro.php'><img src='img/edit_1.png'/></a></td>";
            echo"<td><a href='Eliminar_Usuario.php'><img src='img/delete.png'/></a></td>";
            echo"</tr>";
        }
        echo"</table>";
        ?>
    </center> 
</body>
</html>
