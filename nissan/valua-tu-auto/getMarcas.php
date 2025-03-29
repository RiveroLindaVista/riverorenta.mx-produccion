<?php
include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$sql = "Select marca from valuacion_autometrica WHERE year =".$_POST["ano"]." group by marca order by marca asc";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['marca'].'">'. $row['marca'].'</option>';
    }
}

return $opcionesMarcas;
?>