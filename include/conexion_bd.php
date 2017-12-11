<?php

function conn_mssqlInvernadero() {

    $Servidor = "Moran";
    $Usuario = "sa";
    $Password = "sa";
    $BaseDatos = "Invernadero";
  
    // peticion para conectar a la base de datos
    if (!($conexion = mssql_connect($Servidor, $Usuario, $Password))){
        die("Error al conectar a la base de datos");
    }
    // seleccionamos la BD restauradores
    if (!mssql_select_db($BaseDatos, $conexion)){
        die("No existe la BD");
    }

    return $conexion;
}




