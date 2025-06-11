<?php
// include_once "env_define.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Database{

    private $host = getenv('DB_HOST');// DB_HOST;
    private $database = getenv('DB_DB');// DB_DB;
    private $user = getenv('DB_USER');// DB_USER;
    private $password = getenv('DB_PASSWORD');//DB_PASSWORD;
    private $mbd;
    



    
    function connect(){
        

echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_DB: " . getenv('DB_DB') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "DB_PASSWORD: " . getenv('DB_PASSWORD') . "<br>";



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