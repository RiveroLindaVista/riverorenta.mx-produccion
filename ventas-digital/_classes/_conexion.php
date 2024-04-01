<?php
    /**
     * Clase conexion base de datos
     */
class Database{
    private $_conne2;
 
    function connect() {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DB);
        if (!$con) {
            die('Could not connect to database!');
        } else {
            $_conne2 = $con;
        }
        return  $_conne2;
    }

    function close() {
        mysqli_close($_conne2);
    }
}

?>