<?php
// Conexion para Railway usando variables nativas de MySQL
$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT'); 
$db   = getenv('MYSQLDATABASE');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');

if (!$host || !$db || !$user) {
    die("Error: Variables de entorno de MySQL no encontradas en Railway");
}

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error de conexión MySQL: ". $e->getMessage());
}
?>
