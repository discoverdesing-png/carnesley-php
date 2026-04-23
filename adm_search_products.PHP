<?php
include('conexion.php');
$q = $_GET['q'];

$query = "SELECT * FROM add_product WHERE codigo LIKE '%$q%' OR nombre LIKE '%$q%' OR descripcion LIKE '%$q%' ORDER BY id DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<div style='background-color: #fff; padding: 10px; border-bottom: 1px solid #ddd; cursor: pointer;' onclick='window.location.href=\"adm_mod_product.php?id=" . $row['id'] . "\"'>";
    echo "<p><strong>" . $row['nombre'] . "</strong> - " . $row['descripcion'] . " - " . $row['cantidad'] . " " . $row['unidad_medida'] . "</p>";
    echo "</div>";
}
?>