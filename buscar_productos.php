<?php
include('conexion.php');

$query = $_GET['q'];
$sql = "SELECT * FROM add_product WHERE nombre LIKE '%$query%' OR codigo LIKE '%$query%' OR descripcion LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr onclick='seleccionarProducto(event, " . $row['id'] . ", \"" . $row['codigo'] . "\", \"" . $row['nombre'] . "\", \"" . $row['descripcion'] . "\", \"" . $row['variante'] . "\", " . $row['cantidad'] . ", \"" . $row['unidad_medida'] . "\")'>";
        echo "<td>" . $row['codigo'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . $row['cantidad'] . "</td>";
        echo "<td>" . $row['unidad_medida'] . "</td>";
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="5">No se encontraron resultados</td></tr>';
}
?>