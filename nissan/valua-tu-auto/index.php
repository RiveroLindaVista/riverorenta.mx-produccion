<?php
include("_config.php");
echo 'HOLA';
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$sql = "Select year from valuacion_autometrica group by year order by year desc";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesYears.='<option value="'.$row['year'].'">'. $row['year'].'</option>';
        echo $row['year'];
    }
 }
 ?>

 <h1>Cuéntanos sobre tu auto</h1>
 <select class="form-control" id="filtroYears">
        <?=$opcionesYears?>
    </select>
