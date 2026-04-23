<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Control Carnes Ley (ADM)</title>
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

        #botones-container {
            margin-top: 100px;
            text-align: center;
        }

        .boton {
          display: inline-block;
          width: 150px;
          height: 150px;
          margin: 10px;
          border: 1px solid #ccc;
          border-radius: 10px;
          background-color: #f0f0f0;
          text-align: center;
          padding: 20px;
          box-sizing: border-box;
        }

        .boton span {
          font-size: 16px;
          font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li style="margin-right: auto;">Bienvenido, <?php echo $_SESSION['username']; ?></li>
            <li><a href="#" class="menu-btn">&#9776;</a>
                <div class="dropdown-content">
                     <a href="dashboard_admin.php" draggable="true">principal</a>
                    <a href="register.php" draggable="true">Registrar Usuario</a>
                    <a href="adm_add_product.php" draggable="true">Agregar</a>
                    <a href="adm_mod_product.php" draggable="true">Modificar</a>
                    <a href="buscar.php" draggable="true">Buscador</a>
                    <a href="Valor_Stock.php" draggable="true">Valor de Stock</a>
                    <a href="adm_rojo.php" draggable="true">Stock en Rojo</a>
                    <a href="adm_naranja.php" draggable="true">Stock en Naranja</a>
                    <a href="adm_verde.php" draggable="true">Stock en Verde</a>
                    <a href="fornatoinv.php" draggable="true">Inventario</a>
                </div>
            </li>
            <li><button class="logout-btn" id="logout-btn">Cerrar sesión</button></li>
        </ul>
    </div>

    <div id="botones-container"></div>

    <script>
        const logoutBtn = document.getElementById('logout-btn');
        const menuBtn = document.querySelector('.menu-btn');
        const dropdownContent = document.querySelector('.dropdown-content');
        const menu = document.querySelector('.dropdown-content');
        const botonesContainer = document.getElementById('botones-container');

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

        menu.addEventListener('dragstart', (e) => {
          if (e.target.tagName === 'A') {
            e.dataTransfer.setData('text', e.target.textContent);
            e.dataTransfer.setData('href', e.target.getAttribute('href'));
          }
        });

        botonesContainer.addEventListener('dragover', (e) => {
          e.preventDefault();
        });

        botonesContainer.addEventListener('drop', (e) => {
          e.preventDefault();
          const texto = e.dataTransfer.getData('text');
          const href = e.dataTransfer.getData('href');
          const boton = document.createElement('div');
          boton.classList.add('boton');
          boton.innerHTML = `
            <span>${texto}</span>
          `;
          boton.addEventListener('click', () => {
            window.location.href = href;
          });
          botonesContainer.appendChild(boton);
        });
    </script>
</body>
</html>