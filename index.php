<?php
include('conexion.php');
session_start();

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement = sin SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // OJO: Tus passwords están en texto plano. Deberías usar password_hash()
        if ($password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            
            if (strtolower($username) == 'admin') {
                header("Location: dashboard_admin.php");
                exit;
            } else {
                header("Location: dashboard.php");
                exit;
            }
        } else {
            $error = "Usuario o contraseña incorrecta";
        }
    } else {
        $error = "Usuario o contraseña incorrecta";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de sesión</h2>
        <form id="login-form" method="post" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <input type="text" style="display:none">
            <input type="password" style="display:none">
            <input type="text" id="username" name="username" placeholder="Usuario" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <input type="password" id="password" name="password" placeholder="Contraseña" autocomplete="nope" readonly onfocus="this.removeAttribute('readonly');">
            <input type="submit" name="login" value="Aceptar">
        </form>
        <div id="error-message"><?php if (isset($error)) { echo $error; } ?></div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const errorMessage = document.getElementById('error-message');

        loginForm.addEventListener('submit', (e) => {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username === '' || password === '') {
                e.preventDefault();
                errorMessage.textContent = 'Por favor, rellene todos los campos';
            } else if (password.length < 5) {
                e.preventDefault();
                errorMessage.textContent = 'La contraseña debe tener al menos 5 caracteres';
            }
        });

        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
    </script>
</body>
</html>
