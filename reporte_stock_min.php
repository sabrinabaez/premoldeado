<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_productos_stock_bajo.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Consulta para obtener productos con stock bajo
$query = "SELECT productos.productos_ancho, 
productos.productos_alto, 
productos.productos_largo, 
productos.productos_unidad_medida, 
productos_fabricados.productos_fabricados_cant_disponible, 
productos_fabricados.productos_fabricados_stock_minimo
FROM productos_fabricados
JOIN productos ON productos_fabricados.rela_productos = productos.id_productos";

// Ejecutar la consulta
$result = $mysql->query($query);

// Comprobar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $mysql->error);
}

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear la tabla con los resultados
    echo "<table border='1'>";
    echo "<tr><th>Ancho</th><th>Alto</th><th>Largo</th><th>Unidad de Medida</th><th>Stock Disponible</th><th>Stock Mínimo</th></tr>";

    // Mostrar los resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['productos_ancho'] . "</td>
                  <td>" . $row['productos_alto'] . "</td>
                  <td>" . $row['productos_largo'] . "</td>
                  <td>" . $row['productos_unidad_medida'] . "</td>
                  <td>" . $row['productos_fabricados_cant_disponible'] . "</td>
                  <td>" . $row['productos_fabricados_stock_minimo'] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron productos con stock bajo.";
}

// Cerrar la conexión
$mysql->close();

?>
