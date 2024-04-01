<?php
    //Si se quiere subir una imagen
    if (isset($_POST['subir'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    $idInput = $_POST['idInput'];

    //Si el archivo contiene algo y es diferente de vacio
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            //echo "El nombre del archivo es: $temp";
            //echo "El tipo del archivo es: $tipo";
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "webp") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                - Se permiten archivos .gif, .jpg, .png. y de 900 kb como máximo.</b></div>';
            }
            else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                $directorio = 'images-campaing/'.$idInput;
                
                $str = "image/jpg";
                $explodeTipo = explode("image/",$tipo);
                $nuevoDirectorio = 'images-campaing/'.$idInput.'/imagen.'.$explodeTipo[1];
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true);

                    if (move_uploaded_file($temp,  $nuevoDirectorio)) {
                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod($directorio, 0777);
                        //Mostramos el mensaje de que se ha subido co éxito
                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                        //Mostramos la imagen subida
                        echo '<p><img id="img1" src="'.$nuevoDirectorio.'"/imagen""></p>';

                        echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
                    }
                    else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
                    }
                } else {
                    echo '<div><b>La imagen ya existe</b></div>';
                    echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
                }

            }
        } else {
            echo '<div><b>No eligio imagen. Favor de seleccionar una imagen.</b></div>';
            echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
        }
    }

    if(isset($_POST['idInputReemplazar'])){

        $scriptReemplazar = $_POST['idInputReemplazar'];
        $scriptNuevo = $_POST['idInputReemplazarNuevo'];

        $directorio = 'images-campaing/'.$scriptReemplazar;

        if(file_exists($directorio)){
            echo "Existe la carpeta $directorio"; 
            rename ("$directorio", "images-campaing/$scriptNuevo");
            echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
        } else {
            echo "No existe la carpeta $directorio"; 
            echo "<script> window.location='https://riverorenta.mx/produccion/campania-facebook/'; </script>";
        }

    }
?>