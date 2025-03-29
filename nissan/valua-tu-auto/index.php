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

$sqlMarcas = "Select marca from valuacion_autometrica group by marca order by marca asc";
$marcasQry = $conn->query($sqlMarcas);
if ($marcasQry->num_rows > 0) {
    while($row = $marcasQry->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['marca'].'">'. $row['marca'].'</option>';
    }
 }
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
        <div class="container" style="background-color:#d40028;">
            <h1 class="text-white">Cuéntanos sobre tu auto</h1>
            <label for="inputPassword6" class="col-form-label">Año:</label>
            <select class="form-control" id="filtroYears">
                <option value="0">Selecciona el año</option>
                <?=$opcionesYears?>
            </select>
            <select class="form-control" id="filtroMarcas">
                <?=$opcionesMarcas?>
            </select>
        </div>
    </div>
    </body>
    
</html>
