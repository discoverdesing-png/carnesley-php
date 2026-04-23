<?php
include('conexion.php');

$query = "SELECT * FROM add_product ORDER BY id DESC LIMIT 20";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<tr onclick='seleccionarProducto(event, " . $row['id'] . ", \"" . $row['codigo'] . "\", \"" . $row['nombre'] . "\", \"" . $row['descripcion'] . "\", \"" . $row['variante'] . "\", " . $row['cantidad'] . ", \"" . $row['unidad_medida'] . "\")'>";
    echo "<td>" . $row['codigo'] . "</td>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['descripcion'] . "</td>";
    echo "<td>" . $row['cantidad'] . "</td>";
    echo "<td>" . $row['unidad_medida'] . "</td>";
    echo "</tr>";
}
?>