<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_ventas_mensuales.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Consulta para ventas agrupadas por mes
$query = "
      SELECT MONTH(f.factura_fecha) AS mes, 
       YEAR(f.factura_fecha) AS anio, 
       SUM(f.factura_total) AS total_ventas
      FROM factura_cabecera f
      GROUP BY YEAR(f.factura_fecha), MONTH(f.factura_fecha)
      ORDER BY anio DESC, mes DESC;";

$result = $mysql->query($query);

echo "<table border='1'>";
echo "<tr><th>Mes</th><th>Anio</th><th>Total Ventas</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['mes'] . "</td>
              <td>" . $row['anio'] . "</td>
              <td>" . $row['total_ventas'] . "</td></tr>";
}

echo "</table>";
$mysql->close();
?>
