<?php
// include_once "env_define.php";

class Database{


    



    
    function connect(){
        
        try {
                $pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DB'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );
    echo "Conexión exitosa";
    return $pdo;
            // $this->mbd = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password);
            // // echo "Conexión realizada Satisfactoriamentes";
            // return $this->mbd;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function disconnect(){
        return null;
    }

    
}

?>