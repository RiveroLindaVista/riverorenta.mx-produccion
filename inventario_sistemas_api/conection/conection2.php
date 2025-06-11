<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_DB: " . getenv('DB_DB') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "DB_PASSWORD: " . getenv('DB_PASSWORD') . "<br>";

try {
    $pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DB'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>