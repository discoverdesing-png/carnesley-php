<?php
include('conexion.php');
session_start();

// Si ya hay sesión activa, redirige
if (isset($_SESSION['username'])) {
    if (strtolower($_SESSION['username']) == 'admin') {
        header("Location: dashboard_admin.php");
        exit;
    } else {
        header("Location: dashboard.php");
        exit;
    }
}

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        $error = 'Por favor, rellene todos los campos';
    } else {
        // BUG ARREGLADO: tenías "username =?" sin espacio. PDO falla así.
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // OJO: Tus passwords están en texto plano. Cuando uses password_hash(), cambia a password_verify()
            if ($password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                
                if (strtolower($user['username']) == 'admin') {
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
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - Carnesley</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <link rel="stylesheet" href="style.css">
    <style>
     .login-container {
        width: 100%;
        max-width: 400px;
        margin: 100px auto;
        padding: 30px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
     }
     .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
     }
     .login-container input[type="text"],
     .login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
     }
     .login-container input[type="submit"] {
        width: 100%;
        background-color: #333;
        color: white;
        padding: 14px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
     }
     .login-container input[type="submit"]:hover {
        background-color: #555;
     }
     #error-message {
        color: #d32f2f;
        text-align: center;
        margin-top: 10px;
        min-height: 20px;
     }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de sesión</h2>
        <form id="login-form" method="post" autocomplete="off">
            <input type="text" name="username" id="username" placeholder="Usuario" 
                   autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <input type="password" name="password" id="password" placeholder="Contraseña" autocomplete="new-password">
            <input type="submit" name="login" value="Aceptar">
        </form>
        <div id="error-message"><?php echo $error; ?></div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const errorMessage = document.getElementById('error-message');

        loginForm.addEventListener('submit', (e) => {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            if (username === '' || password === '') {
                e.preventDefault();
                errorMessage.textContent = 'Por favor, rellene todos los campos';
            } else if (password.length < 5) {
                e.preventDefault();
                errorMessage.textContent = 'La contraseña debe tener al menos 5 caracteres';
            }
        });
    </script>
</body>
</html>
