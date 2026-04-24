<?php
// conexion.php - PDO para Railway MySQL
$host = getenv('MYSQLHOST');     // mysql.railway.internal
$port = getenv('MYSQLPORT');     // 3306
$db   = getenv('MYSQLDATABASE'); // railway
$user = getenv('MYSQLUSER');     // root
$pass = getenv('MYSQLPASSWORD'); // tu password

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
    die("Error de conexión MySQL: " . $e->getMessage());
}
?>
