<?php
include('conexion.php');

$q = $_GET['q'];

$query = "SELECT * FROM add_product WHERE codigo LIKE '%$q%' OR nombre LIKE '%$q%' OR descripcion LIKE '%$q%' ORDER BY id DESC";
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