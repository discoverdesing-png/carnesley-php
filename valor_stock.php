<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Conectar a la base de datos
include('conexion.php');

// Guardar los cambios
if (isset($_POST['guardar'])) {
    $error = false;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'cantidad_minima_') === 0 || strpos($key, 'cantidad_maxima_') === 0 || strpos($key, 'excedente_') === 0 || strpos($key, 'cantidad_') === 0) {
            if (trim($value) == '') {
                $error = true;
                break;
            } elseif (!is_numeric($value)) {
                $error = true;
                break;
            }
        }
    }
    if ($error) {
        echo "<script>alert('Todos los campos son obligatorios y deben ser numéricos');</script>";
    } else {
        foreach ($_POST as $key => $value) {
            $value = trim($value);
            if (strpos($key, 'cantidad_minima_') === 0) {
                $id = explode('_', $key)[2];
                $query = "UPDATE add_product SET cantidad_minima = '$value' WHERE id = '$id'";
                $conn->query($query);
            } elseif (strpos($key, 'cantidad_maxima_') === 0) {
                $id = explode('_', $key)[2];
                $query = "UPDATE add_product SET cantidad_maxima = '$value' WHERE id = '$id'";
                $conn->query($query);
            } elseif (strpos($key, 'excedente_') === 0) {
                $id = explode('_', $key)[1];
                $query = "UPDATE add_product SET excedente = '$value' WHERE id = '$id'";
                $conn->query($query);
            } elseif (strpos($key, 'cantidad_') === 0) {
                $id = explode('_', $key)[1];
                $query = "UPDATE add_product SET cantidad = '$value' WHERE id = '$id'";
                $conn->query($query);
            }
        }
        echo "<script>window.location.href='Valor_Stock.php';</script>";
        exit;
    }
}

// Mostrar la lista de productos
$query = "SELECT * FROM add_product";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Valor de Stock</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <link rel="stylesheet" href="style.css">
    <style>
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
                     <a href="dashboard_admin.php">principal</a>
                    <a href="register.php">Registrar Usuario</a>
                    <a href="adm_add_product.php">Agregar</a>
                    <a href="adm_mod_product.php">Modificar</a>
                    <a href="buscar.php">Buscador</a>
                    <a href="Valor_Stock.php">Valor de Stock</a>
                    <a href="adm_rojo.php">Stock en Rojo</a>
                    <a href="adm_naranja.php">Stock en Naranja</a>
                    <a href="adm_verde.php">Stock en Verde</a>
                </div>
            </li>
            <li><button class="logout-btn" id="logout-btn">Cerrar sesión</button></li>
        </ul>
    </div>

    <div class="container">
        <div class="list-container">
            <h2 style="text-align: center;">Valor de Stock</h2>
           <form method="post">
                <table id="productos-table">
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
            <td style="padding: 0; width: 10%;"><input type="number" name="cantidad_<?php echo $row['id']; ?>" value="<?php echo $row['cantidad']; ?>" style="width: 40px;"></td>
            <td style="padding: 0; width: 10%;"><input type="number" name="cantidad_minima_<?php echo $row['id']; ?>" value="<?php echo $row['cantidad_minima']; ?>" style="width: 40px;"></td>
            <td style="padding: 0; width: 10%;"><input type="number" name="cantidad_maxima_<?php echo $row['id']; ?>" value="<?php echo $row['cantidad_maxima']; ?>" style="width: 40px;"></td>
            <td style="padding: 0; width: 10%;"><input type="number" name="excedente_<?php echo $row['id']; ?>" value="<?php echo $row['excedente']; ?>" style="width: 40px;"></td>
        </tr>
    <?php } ?>
</table>
                <div style="text-align: center; margin-top: 20px;">
                    <input type="submit" name="guardar" value="Guardar" style="padding: 10px; background-color: #f31208; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                </div>
            </form>
        </div>
    </div>

    <script>
        const logoutBtn = document.getElementById('logout-btn');
        const menuBtn = document.querySelector('.menu-btn');
        const dropdownContent = document.querySelector('.dropdown-content');

        logoutBtn.addEventListener('click', () => {
            fetch('logout.php')
                .then((response) => {
                    if (response