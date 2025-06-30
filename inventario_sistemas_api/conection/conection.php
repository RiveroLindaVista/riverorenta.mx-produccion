<?php
// include_once "env_define.php";

class Database{

    private $host;
    private $database;
    private $user;
    private $password;
    private $mbd;
    
    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->database = getenv('DB_DB');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
    }


    
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