<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cotrol Carnes Ley</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
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
        .nav-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-bar ul li {
            margin-right: 20px;
            position: relative;
        }
        .nav-bar a {
            color: #fff;
            text-decoration: none;
        }
        .nav-bar a:hover {
            color: #ccc;
        }
        .logout-btn {
            background-color: #f31208;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #8e413e;
        }
        .container {
            width: 80%;
            margin: 80px auto 40px auto;
            
            justify-content: space-between;
        }
        .search-bar {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
        #product-table tr:hover {
            background-color: #f7f7f7;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }
        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #444;
        }
        .menu-btn:hover + .dropdown-content {
            display: block;
        }
        .dropdown-content:hover {
            display: block;
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
    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li style="margin-right: auto;">Bienvenido, <?php echo $_SESSION['username']; ?></li>
            <li><a href="#" class="menu-btn">&#9776;</a>
                <div class="dropdown-content">
                    <a href="dashboard.php">principal</a>
                    <a href="inventario.php">Inventario</a>                    
                    <a href="productos_rojo.php">Stock en Rojo</a>
                    <a href="productos_naranja.php">Stock en Naranja</a>
                    <a href="productos_verde.php">Stock en Verde</a>
                    <a href="fornatoinv.php">Formato Inventario</a>
                </div>
            </li>
            <li><button class="logout-btn" id="logout-btn">Cerrar sesión</button></li>
        </ul>
    </div>

    <div class="container">
        <input type="text" id="search-bar" class="search-bar" placeholder="Buscar productos...">
        <table id="product-table">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
            <?php
            include('conexion.php');
            $query = "SELECT * FROM add_product ORDER BY id DESC";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['codigo'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['cantidad'] . " " . $row['unidad_medida'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <script>
        const logoutBtn = document.getElementById('logout-btn');
        const menuBtn = document.querySelector('.menu-btn');
        const dropdownContent = document.querySelector('.dropdown-content');
        const searchBar = document.getElementById('search-bar');
        const productTable = document.getElementById('product-table');

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

        searchBar.addEventListener('input', () => {
            const searchValue = searchBar.value.toLowerCase();
            fetch(`search_products.php?q=${searchValue}`)
                .then((response) => response.text())
                .then((data) => {
                    productTable.innerHTML = data;
                })
                .catch((error) => {
                    console.error(error);
                });
        });
    </script>
</body>
</html>