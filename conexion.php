<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Si quieres ver qué está leyendo Railway, descomenta la línea de abajo 1 vez
// die("HOST:$host DB:$db USER:$user PORT:$port PASS:$pass");

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión MySQL: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
