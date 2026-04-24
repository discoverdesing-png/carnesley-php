<?php
// Conexion PDO para Railway MySQL
// Railway inyecta variables con prefijo MYSQL*, no DB_*

$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT'); 
$db   = getenv('MYSQLDATABASE');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');

// Si alguna variable falta, truena con mensaje claro
if (!$host || !$db || !$user) {
    die("Error: Variables de MySQL no encontradas. Asegúrate de linkear el servicio MySQL en Railway > Variables > Add Reference");
}

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    $conn = new PDO($dsn, $user, $pass, $options);
    
} catch(PDOException $e) {
    // En producción quita el $e->getMessage() para no exponer detalles
    die("Error de conexión MySQL: " . $e->getMessage());
}
?>
