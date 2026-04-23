<?php
require __DIR__ . '/vendor/autoload.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['add_product'])) {
    include('conexion.php');
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $variante = $_POST['variante'];
    $cantidad = $_POST['cantidad'];
    $unidad_medida = $_POST['unidad_medida'];

    // Verificar si todos los campos están llenos
    if (empty($codigo) || empty($nombre) || empty($descripcion) || empty($variante) || empty($cantidad) || empty($unidad_medida)) {
        $mensaje = "Por favor, llene todos los campos";
    } else {
        // Verificar si el código ya existe
        $query = "SELECT * FROM add_product WHERE codigo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $mensaje = "El código ya existe";
        } else {
            $query = "INSERT INTO add_product (codigo, nombre, descripcion, variante, cantidad, unidad_medida) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssis", $codigo, $nombre, $descripcion, $variante, $cantidad, $unidad_medida);

            if ($stmt->execute()) {
                header("Location: adm_add_product.php");
                exit;
            } else {
                $mensaje = "Error al agregar producto: " . $conn->error;
            }
        }
    }
}

if (isset($_POST['exportar_excel'])) {
    header('Location: exportar_excel.php');
    exit;
}

if (isset($_POST['preview_pdf'])) {
    header('Location: preview_pdf.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <link rel="stylesheet" href="style.css">
    <style>
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
    display: flex;
    justify-content: space-between;
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
        <?php if (isset($mensaje)) { ?>
    <div class="error-message" style="background-color: #f31208; color: #fff; text-align: center; padding: 10px; margin-bottom: 20px;">
        <?php echo $mensaje; ?>
    </div>
    <script>
        setTimeout(function() {
            document.querySelector('.error-message').style.display = 'none';
        }, 4000);
    </script>
<?php } ?>
    <div class="container">
        <div class="form-container">
            <h2>Agregar Producto</h2>
            <form method="post">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" required>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" required></textarea>

                <label for="variante">Variante:</label>
                <input type="text" name="variante" required>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" required>

                <label for="unidad_medida">Unidad de Medida:</label>
                <select name="unidad_medida" required>
                    <option value="pieza">Pieza</option>
                    <option value="kilo">Kilo</option>
                </select>

                <input type="submit" name="add_product" value="Agregar Producto">
            </form>
        </div>
        <div class="list-container">
            <h2>Últimos 20 Productos</h2>
            <table>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                </tr>
                <?php
                include('conexion.php');
                $query = "SELECT * FROM add_product ORDER BY id DESC LIMIT 20";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['codigo'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>" . $row['unidad_medida'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <form method="post">
                <input type="submit" name="exportar_excel" value="Exportar a Excel">
                <input type="submit" name="preview_pdf" value="Preview PDF">
            </form>
        </div>
    </div>

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