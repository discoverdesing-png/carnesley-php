<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnesley";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos que estén en rojo
$query = "SELECT * FROM add_product WHERE cantidad <= cantidad_minima";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos en Rojo</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
                .dropdown-content a[href="productos_rojo.php"] {
            background-color: #8B0A0A;
        }

        .dropdown-content a[href="productos_rojo.php"]:hover {
            background-color: #FF0000;
        }

        .dropdown-content a[href="productos_naranja.php"] {
            background-color: #FFA07A;
        }

        .dropdown-content a[href="productos_naranja.php"]:hover {
            background-color: #FF9900;
        }

        .dropdown-content a[href="productos_verde.php"] {
            background-color: #32CD32;
        }

        .dropdown-content a[href="productos_verde.php"]:hover {
            background-color: #008000;
        }

    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li style="margin-right: auto;">Bienvenido, <?php echo $_SESSION['username']; ?></li>
            <li><a href="#" class="menu-btn">&#9776;</a>
                <div class="dropdown-content">
                    <a href="dashboard.php">Principal</a>
                    <a href="inventario.php">Inventario</a>
                    <a href="productos_rojo.php">Stock en Rojo</a>
                    <a href="productos_naranja.php">Stock en Naranja</a>
                    <a href="productos_verde.php">Stock en Verde</a>
                    <a href="formatoinv.php">Formato Inventario</a>  
                </div>
            </li>
            <li><button class="logout-btn" id="logout-btn">Cerrar sesión</button></li>
        </ul>
    </div>
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 20px; width: 100%;">Productos en Rojo</h1>
    </div>
    <div class="container">
        <table id="productos-table" style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="width: 60%;">Producto</th>
                <th style="width: 10%;">Cant.</th>
                <th style="width: 10%;">Min.</th>
                <th style="width: 10%;">Max.</th>
                <th style="width: 10%;">Exc.</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td style="word-wrap: break-word; width: 60%;"><?php echo $row['nombre']; ?></td>
                    <td style="text-align: center; width: 10%; color: red;"><?php echo $row['cantidad']; ?></td>
                    <td style="width: 10%;"><?php echo $row['cantidad_minima']; ?></td>
                    <td style="width: 10%;"><?php echo $row['cantidad_maxima']; ?></td>
                    <td style="width: 10%;"><?php echo $row['excedente']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
    // Cerrar la conexión
    $conn->close();
    ?>
    <script>
        const logoutBtn = document.getElementById('logout-btn');

        logoutBtn.addEventListener('click', () => {
            fetch('logout.php')
                .then((response) => {
                    if (response.ok) {
                        window.location.href = 'index.php';
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        });
    </script>
</body>
</html>