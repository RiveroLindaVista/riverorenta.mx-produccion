<?php
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Monterrey');
include "class.upload.php";

try {
    if (isset($_FILES["imagen"])) {
        $up = new Upload($_FILES["imagen"]);
        $slug = $_POST["slug"];
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        if ($extension != "pdf"){
            echo "jpg";
            return 0;
        }
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        if ($up->uploaded) {
            $new_name = $slug;
            $up->file_new_name_body = $new_name;
            if(file_exists("../../../../gruporivero/pdf".$file_new_name_body)) {
                
                unlink("../../../../gruporivero/pdf/$new_name.pdf");
                move_uploaded_file($rutaTemporal,"../../../../gruporivero/pdf/$new_name.pdf");
                echo ("ok");
            } else {
                $up->Process("../../../../gruporivero/pdf");
                if ($up->processed) {
                    echo json_encode("ok");
                } else {
                    echo json_encode("error processing");
                }
            }
/*             $up->Process("../../../../gruporivero/pdf");
            if ($up->processed) {
                echo json_encode("ok");
            } else {
                echo json_encode("error processing");
            } */
        } else {
            echo json_encode("error upload");
        }
    }
} catch (\Throwable $th) {
    echo json_encode('error :'.$th);
}
?>
