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

            <div class="row p-2" id="divModelos" hidden>
                <select class="form-select" id="filtroModelos">
                </select>
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
                
                let opcionesMarcas = '';
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
                console.log(resp);
                
                let opcionesModelos = '';
                resp.forEach(elem => {
                    opcionesModelos += `
                            <option value="${elem.modelo}">${elem.modelo}</option>
                    `;
                });

                console.log(opcionesModelos);
                $("#divModelos").attr('hidden', false);
                $("#filtroModelos").html(opcionesModelos);
            }
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

    @keyframes slide-in {
    from {
        translate: 0 -20px;
    }

    to {
        translate: 0 0;
    }
    }
</style>
