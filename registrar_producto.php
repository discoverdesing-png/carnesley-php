<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
    if (isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['variante']) && isset($_POST['cantidad']) && isset($_POST['unidad_medida'])) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $variante = $_POST['variante'];
        $cantidad = $_POST['cantidad'];
        $unidad_medida = $_POST['unidad_medida'];

        if (!empty($codigo) && !empty($nombre) && !empty($descripcion) && !empty($variante) && !empty($cantidad)) {
            include('conexion.php');
            $query = "INSERT INTO nuevo (codigo, nombre, descripcion, variante, cantidad, unidad_medida) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssis", $codigo, $nombre, $descripcion, $variante, $cantidad, $unidad_medida);
            $result = $stmt->execute();
            if ($result) {
                $mensaje = "Producto registrado con éxito";
            } else {
                $mensaje = "Error al registrar producto";
            }
        } else {
            $mensaje = "Por favor, complete todos los campos obligatorios";
        }
    } else {
        $mensaje = "Error al obtener los datos del formulario";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de productos</title>
    <link rel="icon" type="image/png" sizes="32x32" href="ley.png">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container input[type="text"], .container input[type="number"] {
            width: 80%;
            height: 40px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .container input[type="submit"] {
            width: 80%;
            height: 40px;
            background-color: #f31208;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #8e413e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de productos</h2>
        <?php if (isset($mensaje)) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>
        <form method="post">
            <input type="text" name="codigo" placeholder="Código del producto">
            <input type="text" name="nombre" placeholder="Nombre del producto">
            <input type="text" name="descripcion" placeholder="Descripción del producto">
            <input type="text" name="variante" placeholder="Variante del producto">
            <input type="number" name="cantidad" placeholder="Cantidad del producto">
            <select name="unidad_medida">
                <option value="">Seleccione la unidad de medida</option>
                <option value="kilo">Kilo</option>
                <option value="pieza">Pieza</option>
            </select>
            <input type="submit" name="register" value="Registrar producto">
        </form>
    </div>
</body>
</html>