<?php

#================================
# Funciones de consulta basicas
#================================

function consultarMSSQL($query) {

    $dbhandle = conn_mssqlInvernadero();
    $recordset = mssql_query($query, $dbhandle); //or die(mysql_get_());

    return $recordset;
}

function actualizarMSSQL($query) {

    $dbhandle = conn_mssqlInvernadero();

    try {
        $resultado = mssql_query($query, $dbhandle);
        return $resultado;
    } catch (Exception $e) {

        echo "Ocurrio un error al actualizar el usuario ";
    }
}

function borrarMSSQL($query) {

    $dbhandle = conn_mssqlInvernadero();

    try {
        $resultado = mssql_query($query, $dbhandle);
        return $resultado;
    } catch (Exception $e) {

        echo "Ocurrio un error al eliminar el usuario ";
    }
}

function insertarMSSQL($query) {

    $dbhandle = conn_mssqlInvernadero();

    try {
        $resultado = mssql_query($query, $dbhandle);
        return $resultado;
    } catch (Exception $e) {

        echo "Ocurrio un error al insertar el usuario ";
    }
}

