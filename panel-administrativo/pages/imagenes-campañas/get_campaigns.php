<?php
	/**
	 * Clase conexion base de datos
	 */  
    include("../../_inc/_config.php");
class Database{
    private $_host = '172.28.3.240';
    private $_username = 'BDM';
    private $_password = 'adminlv';
    private $_database = 'BDM';
    private $_conne;
 
    function connect() {
        $con = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_database);
        if (!$con) {
            die('Could not connect to database!');
        } else {
            echo 'connect to database!';
            $this->_conne = $con;
        }
        return  $this->_conne;
    }

    function close() {
        mysqli_close($this->_conne);
    }
}

$con2 = new Database;
$con2->connect();

?>