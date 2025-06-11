<?php

// include_once '../conection/conection.php';

class InvSistemasModel extends Database {
    public  function alls() {
        $mbd = Database::connect();

        $sentence = $mbd->prepare('SELECT * FROM inv_sistemas');
        $sentence->execute();
        $resp = $sentence->fetchAll(PDO::FETCH_OBJ);
        
        // echo json_encode('$resp');
        return $resp;

        // $mbd = Database::disconnect();

    }

}

?>