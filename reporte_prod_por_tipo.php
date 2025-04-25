<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estiloreportes.css' type='text/css'>";

// Establecer los encabezados para generar el archivo Excel, que este en UTF 8

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte_produccion_por_tipo.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Conectar a la base de datos, estableciendo UTF
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");

if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$mysql->set_charset("utf8");

if ($mysql->error) {
    die("Error al establecer el conjunto de caracteres: " . $mysql->error);
}



    // Consulta SQL para Producción por Tipo
    $query = "
    SELECT tp.tipo_productos_nombre AS tipo_producto, 
           COUNT(pf.id_productos_fabricados) AS total_fabricados
    FROM productos_fabricados pf
    JOIN productos p ON pf.rela_productos = p.id_productos
    JOIN tipo_productos tp ON p.rela_tipo_productos = tp.id_tipo_productos
    GROUP BY tp.tipo_productos_nombre;
    ";

    // Ejecutar la consulta
    $result = $mysql->query($query);

    if (!$result) {
        die("Error en la consulta: " . $mysql->error);
    }

// Crear la tabla con los resultados
echo "<table border='1'>";
echo "<tr><th>Tipo de Producto</th><th>Total Fabricados</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['tipo_producto'] . "</td>
              <td>" . $row['total_fabricados'] . "</td></tr>";

echo "</table>";
}

// Cerrar la conexión
$mysql->close();
?>
