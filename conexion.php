<?php
// Conexion para Railway - usa getenv() no $_ENV
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Para debug rápido: descomenta 1 vez para ver si lee las variables
// die("HOST:$host DB:$db USER:$user PORT:$port");

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión MySQL: ". $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
