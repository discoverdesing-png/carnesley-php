<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// Conectar a la base de datos
include('conexion.php');

// Mostrar la lista de productos
$query = "SELECT * FROM add_product";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formato de Inventario</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos para el menú */
        .nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
            z-index: 1000;
            box-sizing: border-box;
        }

        .container {
            width: 80%;
            margin: 80px auto 40px auto;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            padding: 10px;
            border: 1px solid #444;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
        }

        .dropdown-content a:hover {
            background-color: #555;
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

        /* Estilos para la tabla */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f0f0f0;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 15%;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 30%;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 38%;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 9%;
        }

        th:nth-child(5), td:nth-child(5) {
            width: 8%;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li style="margin-right: auto;">Bienvenido, <?php echo $_SESSION['username']; ?></li>
            <li><a href="#" class="menu-btn">&#9776;</a>
                <div class="dropdown-content">
                    <a href="dashboard_admin.php">principal</a>
                    <a href="register.php">Registrar Usuario</a>
                    <a href="adm_add_product.php">Agregar</a>
                    <a href="adm_mod_product.php">Modificar</a>
                    <a href="buscar.php">Buscador</a>
                    <a href="Valor_Stock.php">Valor de Stock</a>
                    <a href="adm_rojo.php">Stock en Rojo</a>
                    <a href="adm_naranja.php">Stock en Naranja</a>
                    <a href="adm_verde.php">Stock en Verde</a>
                    <a href="fornatoinv.php">Inventario</a>
                </div>
            </li>
            <li><button class="logout-btn" id="logout-btn">Cerrar sesión</button></li>
        </ul>
    </div>
<div class="container">
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cant.</th>
            <th>Kg/Pz</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        <?php } ?>
    </table>
</div>    </div>

    <script>
        const logoutBtn = document.getElementById('logout-btn');
        const menuBtn = document.querySelector('.menu-btn');
        const dropdownContent = document.querySelector('.dropdown-content');

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

        menuBtn.addEventListener('click', () => {
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>