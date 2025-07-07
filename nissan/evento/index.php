<?php

include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

$hoy = date('Y-m-d');
$manana = strtotime('+1 day', strtotime($hoy));
$manana = date('Y-m-d', $manana);

 $captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
 $captcha_textp = $captcha_text."J89"; 
?>

<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Evento - Nissan Rivero</title>

    <link href="<?=URL?>/estilos/main.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body style="background-color:#1d1d1d;">
        <div style="display:flex; justify-content: center; align-items: center;">
            <div id="formOferta" class="formOferta row" class="p-4">
                <div class="col-xl-8 col-lg-8 col-md-9 col-sm-12"></div>

                <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 d-flex justify-content-center">
                    <img src="logoOffroad.png" style="width:90%" />
                </div>

                <div class="col-xl-8 col-lg-8 col-md-9 col-sm-12"></div>

                <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 d-flex justify-content-center">
                    <div>
                        <div class="form-group pb-2">
                            <label class="labelEvento" for="nombre">Nombre *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Nombre" id="nombre" maxlength="40" name="nombre" type="text" required />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="nombre">Apellidos *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Apellidos" id="apellidos" maxlength="40" name="apellidos" type="text" required />
                        </div>

                        <div class="form-group pb-2" hidden>
                            <input class="inputEvento p-2 mb-1" id="evento" maxlength="40" name="evento" type="text" value="offroad" />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="telefono">Teléfono *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Telefono" id="telefono" maxlength="10" name="telefono" type="text" required />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="email">Correo *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Correo" id="email" maxlength="80" name="email" type="text" required />
                        </div>

                        <div class="form-group p-2 d-flex justify-content-center">
                            <div class="botonEvento text-white px-4 py-0" onclick="enviarRegistro()">ENVIAR</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-9 col-sm-12"></div>

                <div class="d-flex justify-content-center col-xl-4 col-lg-4 col-md-3 col-sm-12 p-0">
                    <img src="logoTinaja.png" style="width:80%" />
                </div>
                
            </div>
        </div>
    </body>
    
</html>
<script>

    function enviarRegistro(){
    
        let nombre = $('#nombre').val();
        let apellidos = $('#apellidos').val();
        let email = $('#email').val();
        let telefono = $('#telefono').val();

        console.log(nombre, apellidos,email,telefono);

        var settings = {
        "url": "https://multimarca.gruporivero.com/api/v1/registro/nissan/insert",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json"
        },
        "data": JSON.stringify({
            "nombre": nombre+" "+apellidos,
            "telefono": telefono,
            "email": email,
            "agencia": "Contry",
            "evento": "OffRoad Rivero"
        }),
        };

        console.log(settings);

        $.ajax(settings).done(function (response) {
        console.log(response);
        });

    }

</script>

<style>
    #divYears{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divMarcas{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divModelos{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divVersiones{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #precio{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #btnOferta{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    .formOferta{
        height: 100vh;
        width: 100vw;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #94001c;
        animation-duration: 1s;
        animation-name: slide-in;
        background-image: url(backOffRoad.png);
        background-size: cover;
    }

    #ofertaFinal{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #94001c;
    }

    #descripcionAuto{
        background-color: white;
        border-top: 2px solid #d40028;
        border-left: 1px solid #d40028;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 1px 2px 3px 1px;
        width: 100%;
    }

    .inputEvento{
        border-radius: 15px;
        background-color:rgba(194, 194, 194, 0.56);
        width: 100px;
    }

    .labelEvento{
        color: white;
    }

    .botonEvento{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
        font-size: 1.6em;
    }

    .btnOfertaNormal{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
    }

    .btnOfertaPrimo{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
    }

    .btnOfertaPrimo:hover{
        background-color:rgb(173, 4, 35);
    }

    .btnOfertaNormal:hover{
        background-color:rgb(173, 4, 35);
    }

    #formCita{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #formDatos{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #formCalendar{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    @keyframes slide-in {
        from {
            translate: 0 -20px;
        }

        to {
            translate: 0 0;
        }
    }

    @keyframes up {
        from {
            translate: 0 0;
        }

        to {
            translate: 0 -200px;
        }
    }

    @font-face{
        font-family: Narrow;
        src: url('Narrow/owners-narrow-black.ttf');
    }

    .imgSucursal{
        width: 600px;
    }

    @media only screen and (max-width: 991px) {
        .formOferta{
            background-position: 15%;
        }
    }
    

    @media only screen and (max-width: 767px) {
        .imgSucursal{
            width: 100%;
        }
    }


</style>
