<?php
require_once("_config.php");

$ano=$_POST['ano'];
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$sql = "SELECT marca FROM valuacion_autometrica WHERE year =".$ano." group by marca, order by marca asc ";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['year'].'">'. $row['year'].'</option>';
    }
}
echo $opcionesMarcas;
?>