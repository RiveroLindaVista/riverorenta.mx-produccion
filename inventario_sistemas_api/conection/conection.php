<?php
include_once "env_define.php";

class Database{

    private $host = DB_HOST;
    private $database = DB_DB;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $mbd;

    



    
    function connect(){
        try {
            $this->mbd = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password);

            // echo "Conexión realizada Satisfactoriamentes";
            return $this->mbd;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function disconnect(){
        $this->mbd = null;
    }

    
}

?>