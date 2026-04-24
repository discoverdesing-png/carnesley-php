<?php
$host = getenv('DB_HOST'); // mysql.railway.internal
$port = getenv('DB_PORT'); // 3306
$db   = getenv('DB_NAME'); // railway
$user = getenv('DB_USER'); // root
$pass = getenv('DB_PASS'); // pLmtoCFCqHZkELifeKhvexrGqVjWpf1O

// Para debug: descomenta esta línea si sigue fallando para ver qué variables llegan
// die("HOST:$host DB:$db USER:$user PORT:$port");

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión MySQL: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
