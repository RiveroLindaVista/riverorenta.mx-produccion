<?php

include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
/* $sql = "Select year from valuacion_autometrica group by year order by year desc";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesYears.='<option value="'.$row['year'].'">'. $row['year'].'</option>';
    }
 } */

/* $sqlMarcas = "Select marca from valuacion_autometrica group by marca order by marca asc";
$marcasQry = $conn->query($sqlMarcas);
if ($marcasQry->num_rows > 0) {
    while($row = $marcasQry->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['marca'].'">'. $row['marca'].'</option>';
    }
 } */
 $captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
 $captcha_textp = $captcha_text."J89"; 
?>

<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Valua tu carro - Nissan Rivero</title>
        
    <link href="<?=URL?>/estilos/main.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>

    <body style="background-color:#1d1d1d;">
    <div class="container" style="display:flex; justify-content: center; align-items: center;">
        <div id="formOferta" class="container p-4">
            <h1 class="text-white text-center" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">CUÉNTANOS SOBRE TU AUTO</h1>
            <div class="row p-2" id="divYears">
                <label for="basic-url" class="form-label text-white">¿Qué año es tu auto?</label>
                <select class="form-select" id="filtroYears" onchange="getMarcas()">
                </select>

            </div>
            <div class="row p-2" id="divMarcas" hidden onchange="getModelos()">
                <select class="form-select" id="filtroMarcas">
                </select>
            </div>

            <div class="row p-2" id="divModelos" hidden onchange="getVersiones()">
                <select class="form-select" id="filtroModelos">
                </select>
            </div>

            <div class="row p-2" id="divVersiones" hidden>
                <select class="form-select" id="filtroVersiones" onchange="getKM()">
                </select>
            </div>

            <div class="row" id="divKM" hidden>
                <div class="input-group p-2 mb-3">
                    <span class="input-group-text" id="basic-addon1">Kilometraje:</span>
                    <input type="number" class="form-control" placeholder="Añade el kilometraje de tu vehículo" aria-label="KM" aria-describedby="basic-addon1" id="filtroKM" onkeypress="upKM()" onkeydown="upKM()">
                </div>
            </div>

            <div class="row" id="captcha" hidden>
                <p class="text-white m-0">Introduce el texto que ves en la imagen:</p>
                <img class="mb-1" src="captcha.php?text=<?= urlencode($captcha_text) ?>" style="width:200px;height: 80px" alt="CAPTCHA"><br>
                <input type="text" id="captcha_input" class="mb-1" name="captcha_input" required><br>
                <p id="msjCaptcha" class="text-white m-0" hidden>Captcha Incorrecto.</p>
                <button type="button" class="btn bg-dark text-white" onclick="getCAPTCHA()">LISTO</button>
            </div>

            <div class="row p-2" id="btnSig" hidden>
                <button class="btn btn-dark bg-dark" type="button" onclick="siguienteDatos()">Siguiente</button>
            </div>

            <div id="cargando" class="spinner-grow text-light text-center" role="status" hidden>
                <span class="visually-hidden">Loading...</span>
            </div>

        </div>

        <div id="ofertaFinal" class="container p-4" hidden>
            <div id="of1">
                <div class="row align-items-center" style="width: 100%;">
                    <h2 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">DESCRIPCIÓN DEL AUTO</h3>

                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div id="descripcionAuto">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="btnOfertaNormal" onclick="selectOferta('normal')">
                        <h3 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">OFERTA VÁLIDA POR 7 DÍAS</h3>

                        <h2 id="precio" class="text-white text-center"></h2>
                        <img style="top: 40px;position:absolute;right: 12px;height: 30px;" src="https://www.riverorenta.mx/valua-tu-carro/img/iconos/flecha_blanca.svg">
                    </div>
                </div>

                <div class="row" id="OfertaPrimo" hidden>
                    <div class="btnOfertaPrimo" onclick="selectOferta('primo')">
                        <h3 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">PRECIO PRIMO VÁLIDO POR 48 HRS</h3>

                        <h2 class="text-white text-center"><img style="height: 50px;filter: saturate(230%);" src="https://www.riverorenta.mx/valua-tu-carro/img/precio-primo.png"><span id="precioPrimo" style="font-size: calc(1.325rem + .9vw);"></span></h2>
                        <div style="font-size:1em;line-height:20px !important">Con el precio Primo tienes solamente 48 horas para tomar la decisión, solo es cuestión que tengas a la mano la siguiente papelería:<br>
                            <ul style="font-size: 1em;margin-top:10px;">
                                <li>Factura Original</li>
                                <li>Refrendos</li>
                                <li>INE</li>
                                <li>Comprobante de Domicilio</li>
                                <li>Constancia de Insitituto de Control Vehicular</li>
                                <li>Carátula Estado de Cuenta Bancario</li>
                            </ul>
                            <img style="top: 40px;position:absolute;right: 12px;height: 30px;" src="https://www.riverorenta.mx/valua-tu-carro/img/iconos/flecha_blanca.svg">
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <button class="btn btn-dark bg-dark" type="button" style="width:auto;" onclick="nuevaOferta()">Elige otro auto</button>
                </div>
            </div>

            <div id="formCita" class="container p-4" hidden>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Nombre:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;" placeholder="Ingresa tu nombre" type="text" id="nombre" name="nombre" required>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Correo:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;" placeholder="Ingresa tu correo" type="text" id="correo" name="correo" required>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Teléfono:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;" placeholder="Ingresa tu teléfono" type="number" id="telefono" max="10" name="telefono" required>
                <div class="row p-2" id="btnOferta" hidden>
                    <button class="btn btn-dark bg-dark" type="button" onclick="getOferta()">Ver Oferta</button>
                </div>
            </div>

        </div>


    </div>
    <input type="hidden" id="descripcion_auto" name="descripcion_auto" value="<?= htmlspecialchars($captcha_textp) ?>">
    </body>
    
</html>
<script>

    var ofertaElegida = '';

$(document).ready(function() {

    let data = {
        ano: 1,
    }

    $.ajax({
            type: "POST",
            url: "getYears.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesYears = '<option value="0">Selecciona el año...</option>';
                resp.forEach(elem => {
                   opcionesYears += `
                        <option value="${elem.year}">${elem.year}</option>
                   `;
                });

                console.log(opcionesYears);
                $("#filtroYears").html(opcionesYears);
            }
        });
})


    function getMarcas(){

        let select_ano = $('#filtroYears').val();

        let data = {
            ano: select_ano,
        }
    
        $.ajax({
            type: "POST",
            url: "getMarcas.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesMarcas = '<option value="0">Selecciona la marca...</option>';
                resp.forEach(elem => {
                   opcionesMarcas += `
                        <option value="${elem.marca}">${elem.marca}</option>
                   `;
                });

                console.log(opcionesMarcas);
                $("#divMarcas").attr('hidden', false);
                $("#filtroMarcas").html(opcionesMarcas);
            }
        });

    }

    function getModelos(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();

        let data = {
            marca: select_marca,
            ano: select_ano,
        }

        $.ajax({
            type: "POST",
            url: "getModelos.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesModelos = '<option value="0">Selecciona el modelo...</option>';
                resp.forEach(elem => {
                    opcionesModelos += `
                            <option value="${elem.modelo}">${elem.modelo}</option>
                    `;
                });

                $("#divModelos").attr('hidden', false);
                $("#filtroModelos").html(opcionesModelos);

            }
        });

    }

    function getVersiones(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();
        let select_modelo = $('#filtroModelos').val();

        let data = {
            modelo: select_modelo,
            marca: select_marca,
            ano: select_ano,
        }

        $.ajax({
            type: "POST",
            url: "getVersiones.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesVersiones = '<option value="0">Selecciona la versión...</option>';
                resp.forEach(elem => {
                    opcionesVersiones += `
                        <option value="${elem.version}">${elem.version}</option>
                    `;
                });

                $("#divVersiones").attr('hidden', false);
                $("#filtroVersiones").html(opcionesVersiones);

            }
        });

    }

    function getKM(){
        $("#divKM").attr('hidden', false);
    }

    function upKM(){
        setTimeout(() => {
            let kms = $("#filtroKM").val();

            if(kms == ""){
                $("#captcha").attr('hidden', true);
            } else {
                $("#captcha").attr('hidden', false);
            }
        }, 300);
    }

    function getOferta(){

        $("#btnOferta").attr('hidden', true);
        $("#cargando").attr('hidden', false);

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();
        let select_modelo = $('#filtroModelos').val();
        let select_version = $('#filtroVersiones').val();
        let select_km = $('#filtroKM').val();

        select_version = select_version.replaceAll(" ", "%20");
        select_modelo = select_modelo.replaceAll(" ", "%20");

        let obj = '{"lineal": [{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "4 pts. LS, 1.3l, TM5, a\/ac., BA, R-15","km_group": "A","sale": 239000,"purchase": 209800},{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "Valor kilometraje","km_group": "A","sale": -4800,"purchase": -4800}]}';
        objetoOferta(JSON.parse(obj));
/*         const requestOptions = {
            method: "GET",
            redirect: "follow"
        };

        fetch("https://multimarca.gruporivero.com/api/v1/autometrica/lineal?empresa=nissan&year="+select_ano+"&brand="+select_marca+"&subbrand="+select_modelo+"&version="+select_version+"&kilometraje="+select_km+"", requestOptions)
        .then((response) => response.text())
        .then((result) => this.objetoOferta(JSON.parse(result)))
        .catch((error) => console.error(error)); */
    }

    function objetoOferta(obj){

        $("#formOferta").attr('hidden', true);
        $("#ofertaFinal").attr('hidden', false);
        let data = obj.lineal;
//NISSAN, CHEVROLET, MAZDA, TOYOTA, HONDA

        let precio = '$ '+new Intl.NumberFormat('en-US').format(obj.lineal[0].purchase)+'.00 MXN';

        let descripcionAuto = `
            <p style="font-family: Narrow;text-align: center;font-size: 2em;">${obj.lineal[0].brand} ${obj.lineal[0].subbrand} ${obj.lineal[0].year}</p>
            <p style="font-family: Narrow;text-align: center;">${obj.lineal[0].version}</p>
            `;
        $("#precio").html(precio);
        $("#descripcionAuto").html(descripcionAuto);

        let precioPrimo = "";

        console.log("Marca: Chevrolet", obj.lineal[0].brand.toLowerCase().includes("chevrolet"));
        console.log("Precio Venta: ", obj.lineal[0].sale);

        if(obj.lineal[0].brand.toLowerCase().includes("chevrolet") == false && obj.lineal[0].brand.toLowerCase().includes("nissan") == false && obj.lineal[0].brand.toLowerCase().includes("mazda") == false && obj.lineal[0].brand.toLowerCase().includes("mazda") == false && obj.lineal[0].brand.toLowerCase().includes("toyota") == false){
            console.log("Entro al primero del IF");
        } else {
            console.log("Entro al SEGUNDO del IF");
            if (obj.lineal[0].sale != "" ){
                let formula = (obj.lineal[0].purchase + obj.lineal[0].sale) / 2;

                precioPrimo = '$ '+new Intl.NumberFormat('en-US').format(formula)+'.00 MXN';
                $("#precioPrimo").html(precioPrimo);
                $("#OfertaPrimo").attr('hidden', false);
            }

        }

        console.log("IGNORO");

    }

    function nuevaOferta(){
        location.reload();
/*         $('#filtroMarcas').val(0);
        $('#filtroYears').val('2026');
        $('#filtroModelos').val(0);
        $('#filtroVersiones').val(0);
        $('#filtroKM').val("");
        $("#cargando").attr('hidden', true);
        $("#divMarcas").attr('hidden', true);
        $("#divModelos").attr('hidden', true);
        $("#divVersiones").attr('hidden', true);
        $("#divKM").attr('hidden', true);

        $("#formOferta").attr('hidden', false);
        $("#ofertaFinal").attr('hidden', true); */

    }

    function getCAPTCHA(){

        let captcha_input = $('#captcha_input').val();
        let descripcion_auto = $('#descripcion_auto').val();

        descripcion_auto = descripcion_auto.substr(0,6);

        let data = {
            captcha_input: captcha_input,
            desca: descripcion_auto,
        }

        $.ajax({
            type: "POST",
            url: "verificar.php",
            data: data,
            dataType: "json",
            success: function(resp) {

                if(resp == "1"){
                    $("#btnSig").attr('hidden', false);
                    $("#captcha").attr('hidden', true);
                    $("#msjCaptcha").attr('hidden', true);
                } else {
                    $("#btnSig").attr('hidden', true);
                    var capt = document.getElementById('captcha_input');
                    capt.style.background= "#f5a0a0fa";
                    $("#msjCaptcha").attr('hidden', false);
                }

            }
        });

    }

    function selectOferta(oferta){
        $("#of1").attr('hidden', true);
        console.log(oferta);
    }

    function siguienteDatos(){
        $("#formCita").attr('hidden', false);
        $("#formOferta").attr('hidden', true);
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

    #formOferta{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #94001c;
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
        max-width: 500px;
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

    @keyframes slide-in {
        from {
            translate: 0 -20px;
        }

        to {
            translate: 0 0;
        }
    }

    @font-face{
        font-family: Narrow;
        src: url('Narrow/owners-narrow-black.ttf');
    }
</style>
