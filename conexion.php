<?php
$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT'); 
$db   = getenv('MYSQLDATABASE'); // Será "railway"
$user = getenv('MYSQLUSER');     // Será "root"
$pass = getenv('MYSQLPASSWORD');

if (!$host || !$db || !$user) {
    die("Error: Faltan variables de MySQL");
}

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch(PDOException $e) {
    die("Error de conexión MySQL: " . $e->getMessage());
}
?>
