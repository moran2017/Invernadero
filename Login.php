<?php
session_start();
//INCLUIMOS LAS FUNCIONES NECESARIAS
require('include/conexion_bd.php');
require('include/funciones_bd.php');

if (isset($_SESSION["session_usuario"])) {

    header("Location:index.php");
}

if (isset($_POST["login"])) {

    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        $USUARIO = strtoupper($_POST['usuario']);
        $PASSWORD = $_POST['password'];
         //$ULTIMO = $_POST['ultimo_acceso'];

        $query = "SELECT * FROM login WHERE usuario='" . $USUARIO . "' AND password='" . $PASSWORD . "'";
        
    
        $resultadoConsulta = consultarMSSQL($query);

        if (!$resultadoConsulta) {
            die("Error no se pudo hace la consulta");
        }
        $num_fila = mssql_num_rows($resultadoConsulta);

        if ($num_fila != 0) {

            while ($fila = mssql_fetch_assoc($resultadoConsulta)) {

                $bdrpe = $fila['usuario'];
                $bdpassword = $fila['password'];
            }

            if ($USUARIO == $bdrpe && $PASSWORD == $bdpassword) {

                $_SESSION['session_usuario'] = $USUARIO;
                header("Location:index.php");
                
             
            }
        } else {
            $message = "Nombre de usuario &oacute; contrase&ntildea invalida!";
        }
    } else {
        $message = "Todos los campos son requeridos!";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Proyecto Final Invernadero</title>

        <!-- Codigo para evitar se guarde cache de esta pagina -->
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Last-Modified" content="0"/>
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="js/jquery_102/themes/custom/jquery-ui-1.10.3.custom.css" />
        <script language="javascript" type="text/javascript" src="js/jquery_102/jquery-1.10.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery_102/jquery-ui-1.10.3.custom.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery_102/jquery.blockUI.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery_102/jquery.validate.min.js"></script>
        <script  language="javascript" type="text/javascript" src="js/jquery_102/localization/messages_es.js"></script>

        <style type="text/css">
            .animacion {
                float:left;
                width:50%;
                margin:0;
                padding:0;
            }

            .animacion_img {
                float:left;
                padding:0px;
                margin:0px;
                border:1px solid #999;
                overflow:hidden;
                position:absolute;
            }

            .animacion_img img {
                float:left;
                position:absolute;
                left:0px;
                top:0px;
                display:none;
            }

            .mlogin {
                margin: 70px auto 0;
              
            }

            .meditar {
                margin: 10px auto 0;
            }

            .error {
                margin: 40px auto 0;
                border: 1px solid #777;
                padding: 3px;
                color: #fff;
                text-align: center;
                width: 350px;
                background: #f58220;
            }

            .regtext {
                font-size: 13px;
                margin-top: 26px;
                color: #777;
            }

            /*= CONTAINERS
            --------------------------------------------------------*/
            .container {
                float: right;
                padding: 70px 70px 25px 10px;
                font-weight: 300;
                overflow: hidden;
                width: 350px;
                height: auto;
                background: #fff;
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.13);
                box-shadow: 0 1px 3px rgba(0,0,0,.13);
            }

            #welcome {
                width: 500px;
                padding: 30px;
                background: #fff;
                margin: 160px auto 0;
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.13);
                box-shadow: 0 1px 3px rgba(0,0,0,.13);
            }

            .container h1 {
                color: #777;
                text-align: center;
                font-weight: 300;
                border: 1px dashed #777;
                margin-top: 13px;
            }

            .container label {
                color: #777;
                font-size: 14px;
            }

            #login {
                 float: right;
                width: 320px;
                margin:auto;
                padding-bottom: 15px;
            }

            .container form .input,.container input[type=text],.container input[type=password],.container input[type=e] {
                background: #fbfbfb;
                font-size: 24px;
                line-height: 1;
                width: 100%;
                padding: 3px;
                margin: 0 6px 5px 0;
                outline: none;
                border: 1px solid #d9d9d9;
            }

            .container form .input:focus {
                border: 1px solid #f58220;
                -webkit-box-shadow: 0 0 3px 0 rgba(245,130,32,0.75);
                -moz-box-shadow: 0 0 3px 0 rgba(245,130,32,0.75);
                box-shadow: 0 0 3px 0 rgba(245,130,32,0.75);
            }

            /*= BUTTONS
            --------------------------------------------------------*/

            .button{
                border: solid 1px #da7c0c;
                background: #f78d1d;
                background: -webkit-gradient(linear, center top, center bottom, from(#faa51a), to(#f47a20));
                background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
                filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');
                color: #fff;
                padding: 7px 12px;
                -webkit-border-radius:4px;
                -moz-border-radius:4px;
                border-radius:4px;
                float: left;
                cursor: pointer;
            }

            .button:hover{
                background: #f47c20;
                background: -webkit-gradient(linear, center top, center bottom, from(#f88e11), to(#f06015));
                background: -moz-linear-gradient(top,  #f88e11,  #f06015);
                filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f88e11', endColorstr='#f06015');
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
        <script type="text/javascript">
            $(document).ready(function () {

                var tiempo_inicio_anim = 500;
                var tiempo_entre_img = 7000;
                var tiempo_fade = 3000;

                function animacion_simple() {

                    $(".foto1").fadeIn(tiempo_fade);

                    setTimeout(function () {

                        $(".foto1").fadeOut(tiempo_fade);

                        $(".foto2").fadeIn(tiempo_fade);

                    }, tiempo_entre_img);

                    setTimeout(function () {

                        $(".foto2").fadeOut(tiempo_fade);

                        $(".foto3").fadeIn(tiempo_fade);

                    }, tiempo_entre_img * 2);

                    setTimeout(function () {

                        $(".foto3").fadeOut(tiempo_fade);

                        $(".foto4").fadeIn(tiempo_fade);

                    }, tiempo_entre_img * 3);

                    setTimeout(function () {

                        $(".foto4").fadeOut(tiempo_fade);

                        $(".foto5").fadeIn(tiempo_fade);


                    }, tiempo_entre_img * 4);

                    setTimeout(function () {

                        $(".foto5").fadeOut(tiempo_fade);

                        $(".foto6").fadeIn(tiempo_fade);

                    }, tiempo_entre_img * 5);

                    setTimeout(function () {

                        $(".foto6").fadeOut(tiempo_fade);

                        animacion_simple();

                    }, tiempo_entre_img * 6);
                }
                setTimeout(function () {
                    animacion_simple();
                }, tiempo_inicio_anim);

            });
        </script>  
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
        <table width="65%">

            <div class="animacion_img" style="width: 65%; height: 90%">  
                <img src="img/foto1.jpg" width="100%" height="90%" class="foto1" />  
                <img src="img/foto2.jpg" width="100%" height="90%" class="foto2" />  
                <img src="img/foto3.jpg" width="100%" height="90%" class="foto3" />
                <img src="img/foto4.jpg" width="100%" height="90%" class="foto4" /> 
                <img src="img/foto5.jpg" width="100%" height="90%" class="foto5" />  
                <img src="img/foto6.jpg" width="100%" height="90%" class="foto6" />  
            </div>  

        </table>

        <table width="35%" align="right">
            
            <div class="container mlogin" >
                <div id="login">
                    <h1>Inicio Sesi&oacute;n</h1>
                    <form name="loginform" id="loginform" action="" method="POST">
                        <p>
                            <label for="user_login">Usuario<br />
                                <input type="text" name="usuario" id="usuario" class="input" value="" size="20" style="text-transform: uppercase;" title="Ingresa tu RPE" /></label>
                        </p>
                        <p>
                            <label for="user_pass">Contrase&ntilde;a<br />
                                <input type="password" name="password" id="password" required placeholder="password" class="input" value="" size="20" title="Ingresa tu contrase&ntilde;a" /></label>
                        </p>
                        <p class="submit">
                            <input type="submit" name="login" class="button" value="Entrar" />
                        </p>
                        <p class="regtext">No estas registrado? <a href="Registro_Usuario.php" >Registrate Aqu&iacute;!</a></p>
                    </form>
                    <br><br><br>
                     <?php
                if (!empty($message)) {
                    echo "<p class='error aling ='center'>$message</p>";
                }
                ?>
                </div>
              
            </div>

           

        </table>

        <div  style="width: 35%; display: none;position: fixed;bottom: 15px; right: 0px; text-align: center;">DERECHOS RESERVADOS<br> Sistemas Exclusivo para uso interno</div>
    </body>
</html>
