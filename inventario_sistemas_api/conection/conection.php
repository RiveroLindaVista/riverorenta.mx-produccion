<?php
// include_once "env_define.php";

class Database{

    private $host = getenv('DB_HOST');// DB_HOST;
    private $database = getenv('DB_DB');// DB_DB;
    private $user = getenv('DB_USER');// DB_USER;
    private $password = getenv('DB_PASSWORD');//DB_PASSWORD;
    private $mbd;
    



    
    function connect(){
        
        try {
                 $this->mbd= new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DB'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );
    echo "Conexión exitosa";
    return $this->mbd;
            // $this->mbd = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password);
            // // echo "Conexión realizada Satisfactoriamentes";
            // return $this->mbd;
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