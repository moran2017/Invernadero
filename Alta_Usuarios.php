
<?php
session_start();

if(!isset($_SESSION["session_usuario"])) { 
 header("location:Login.php"); 
}  else{
    
}
 

//INCLUIMOS LAS FUNCIONES NECESARIAS
require('include/conexion_bd.php');
require('include/funciones_bd.php');

if (isset($_POST["registrar"])) {

    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['usuario']) && !empty($_POST['password'])) {
        $FULL_NAME = strtoupper($_POST['full_name']);
        $EMAIL = $_POST['email'];
        $USUARIO = strtoupper($_POST['usuario']);
        $PASSWORD = md5($_POST['password']);

        $query = "SELECT * FROM login WHERE usuario='" . $USUARIO . "'";

        $resultadoConsulta = consultarMSSQL($query);

        if (!$resultadoConsulta){
            die("Error no se pudo hace la consulta");
        }
        $numrows = mssql_num_rows($resultadoConsulta);

        if ($numrows == 0) {
            $query = "INSERT INTO login (full_name, email, usuario,password) VALUES ('$FULL_NAME','$EMAIL', '$USUARIO', '$PASSWORD')";

            $resultadoConsulta = insertarMSSQL($query);
            if (!$resultadoConsulta){
                die("Error no se pudo hace la consulta");
            }
            if ($resultadoConsulta) {
                $message = "Cuenta Correctamente Creada";
            } else {
                $message = "Error al ingresar datos de la informacion!";
            }
        } else {
            $message = "El nombre de usuario ya existe! Por favor, intenta con otro!";
        }
    } else {
        $message = "Todos los campos no deben de estar vacios!";
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Alta Usuarios</title>

        <!-- Codigo para evitar se guarde cache de esta pagina -->
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Last-Modified" content="0"/>
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>

        <style type="text/css">

          

            .mlogin {
                margin: 170px auto 0;
            }

            .mregistrar {
                margin: 10px auto 0;
            }

            .error {
                margin: 40px auto 0;
                border: 1px solid #777;
                padding: 3px;
                color: #fff;
                text-align: center;
                width: 650px;
                background: #f58220;
            }

            .regtext {
                font-size: 13px;
                margin-top: 26px;
                color: #777;
            }

            .container {
                padding: 25px 16px 25px 10px;
                font-weight: 400;
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
                width: 320px;
                margin: auto;
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
            .button{
                border: solid 1px #da7c0c;
                background: #f78d1d;
                background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
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
                background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015));
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
      
  
        <div class="container mregistrar">
            <div id="login">
                <h1>Registrar Usuario</h1>
                <form name="registrarform" id="registrarform" action="" method="post">
                    <p>
                        <label for="user_login">Nombre Completo<br />
                            <input type="text" name="full_name" id="full_name" class="input" size="32" value="" style="text-transform: uppercase;" title="Ingresa tu nombre completo" /></label>
                    </p>
                    <p>
                        <label for="user_pass">E-mail<br />
                            <input type="email" name="email" id="email" class="input" value="" size="32" title="Ingresa tu correo electronico"  /></label>
                    </p>

                    <p>
                        <label for="user_pass">Usuario<br />
                            <input type="text" name="usuario" id="usuario" class="input" value="" size="20" style="text-transform: uppercase;" title="Ingresa tu Usuario" /></label>
                    </p>

                    <p>
                        <label for="user_pass">Contrase&ntilde;a<br />
                            <input type="password" name="password" id="password" class="input" value="" size="32" title="Ingresa una contrase&ntilde;a segura de al menos 6 caracteres"/></label>
                    </p>	
                    <p class="submit" >
                        <input type="submit" name="registrar" id="registrar" class="button" value="Registrar" />
                    </p>

                </form>
            </div>
        </div>
<?php
if (!empty($message)) {
    echo "<p class=\"error\">" . "Mensaje: " . $message . "</p>";
}
?>
    </body>
</html>
