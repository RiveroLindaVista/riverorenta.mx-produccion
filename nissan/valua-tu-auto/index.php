<?php
include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$sql = "Select year from valuacion_autometrica group by year order by year desc";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesYears.='<option value="'.$row['year'].'">'. $row['year'].'</option>';
    }
 }

/* $sqlMarcas = "Select marca from valuacion_autometrica group by marca order by marca asc";
$marcasQry = $conn->query($sqlMarcas);
if ($marcasQry->num_rows > 0) {
    while($row = $marcasQry->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['marca'].'">'. $row['marca'].'</option>';
    }
 } */
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

    <body>
    <div class="container" style="display:flex; justify-content: center; align-items: center;">
        <div class="container p-4" style="background-color:#d40028;">
            <h1 class="text-white text-center">Cuéntanos sobre tu auto</h1>
            <div class="row p-2" id="divYears">
                <select class="form-select" id="filtroYears" onchange="getMarcas()">
                    <option value="0" disabled>Selecciona el año</option>
                    <?=$opcionesYears?>
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

            <div class="row p-2" id="btnOferta" hidden>
                <button class="btn btn-dark bg-dark" type="button" onclick="getOferta()">Ver Oferta</button>
            </div>

        </div>
    </div>
    </body>
    
</html>
<script>
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
                $("#btnOferta").attr('hidden', true);
            } else {
                $("#btnOferta").attr('hidden', false);
            }
        }, 300);
    }

    function getOferta(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();
        let select_modelo = $('#filtroModelos').val();
        let select_version = $('#filtroVersiones').val();
        let select_km = $('#filtroKM').val();

        select_version = select_version.replaceAll(" ", "%20");
        select_modelo = select_modelo.replaceAll(" ", "%20");

        const requestOptions = {
            method: "GET",
            redirect: "follow"
        };

        fetch("https://multimarca.gruporivero.com/api/v1/autometrica/lineal?empresa=nissan&year="+select_ano+"&brand="+select_marca+"&subbrand="+select_modelo+"&version="+select_version+"&kilometraje="+select_km+"", requestOptions)
        .then((response) => response.text())
        .then((result) => this.objetoOferta(JSON.parse(result)))
        .catch((error) => console.error(error));
    }

    function objetoOferta(obj){
        console.log('KAKAKAK');
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

    @keyframes slide-in {
    from {
        translate: 0 -20px;
    }

    to {
        translate: 0 0;
    }
    }
</style>
