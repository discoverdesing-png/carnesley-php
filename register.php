<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['token'])) {
        $nuevo_usuario = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $token = $_POST['token'];

        if ($token == $_SESSION['token']) {
            if (!empty($nuevo_usuario) && !empty($password) && !empty($confirm_password)) {
                if ($password == $confirm_password) {
                    include('conexion.php');
                    $query = "SELECT * FROM users WHERE username = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $nuevo_usuario);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $mensaje = "El usuario ya existe";
                    } else {
                        if ($stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)")) {
                            $stmt->bind_param("ss", $nuevo_usuario, $password);
                            if ($stmt->execute()) {
                                $mensaje = "Usuario registrado con éxito";
                                unset($_SESSION['token']);
                                header("Location: register.php?mensaje=$mensaje");
                                exit;
                            } else {
                                $mensaje = "Error al registrar usuario: " . $stmt->error;
                            }
                            $stmt->close();
                        } else {
                            $mensaje = "Error al preparar la consulta: " . $conn->error;
                        }
                    }
                } else {
                    $mensaje = "Las contraseñas no coinciden";
                }
            } else {
                $mensaje = "Por favor, complete todos los campos";
            }
        } else {
            $mensaje = "Token inválido";
        }
    } else {
        $mensaje = "Error al obtener los datos del formulario";
    }
}

$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de usuarios</title>
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

    <div class="container">
        <div class="register-container">
            <h2>Registro de usuarios</h2>
            <?php if (isset($mensaje)) { ?>
                <p><?php echo $mensaje; ?></p>
            <?php } ?>
            <form method="post">
                <input type="text" name="username" placeholder="Nombre de usuario" autocomplete="off">
                <input type="password" name="password" placeholder="Contraseña" autocomplete="off">
                <input type="password" name="confirm_password" placeholder="Confirmar contraseña" autocomplete="off">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="submit" name="register" value="Registrar">
            </form>
        </div>
        <div class="users-container">
            <h2>Últimos 3 usuarios registrados</h2>
            <?php
            include('conexion.php');
            $query = "SELECT username, password FROM users ORDER BY id DESC LIMIT 3";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<p>Usuario: " . $row['username'] . ", Contraseña: " . $row['password'] . "</p>";
            }
            ?>
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