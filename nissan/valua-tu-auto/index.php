<?php
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        echo $row['year'];
    }
 }
 ?>