<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estilolistado.css' type='text/css'>";
//poner titulo Listado de productos fabricados en la pagina con css

echo '<h2>Listado de Productos Fabricados</h2>';

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");

if ($mysql->connect_error) {
  die("Problemas con la conexión a la base de datos");
}

// Consultar los productos fabricados y el nombre del tipo de producto
$registros = $mysql->query("SELECT pf.id_productos_fabricados, pf.productos_fabricados_cant_disponible, pf.productos_fabricados_stock_minimo, tp.tipo_productos_nombre
                            FROM productos_fabricados pf
                            JOIN tipo_productos tp ON pf.rela_productos = tp.id_tipo_productos;") or die($mysql->error);

echo '<table>';
echo '<tr>
        <th>ID</th>
        <th>Cantidad Disponible</th>
        <th>Stock Mínimo</th>
        <th>Producto</th>
        <th>Modificar</th>
        <th>Eliminar</th>
      </tr>';

while ($reg = $registros->fetch_array()) {
  echo '<tr>';
  echo '<td>' . $reg['id_productos_fabricados'] . '</td>';
  echo '<td>' . $reg['productos_fabricados_cant_disponible'] . '</td>';
  echo '<td>' . $reg['productos_fabricados_stock_minimo'] . '</td>';
  echo '<td>' . $reg['tipo_productos_nombre'] . '</td>'; // Aquí cambia productos_nombre por tipo_productos_nombre
  echo '<td><a href="frm_modificar.php?id_productos_fabricados=' . $reg['id_productos_fabricados'] . '">Modificar</a></td>';
  echo '<td><a href="baja_fabricados.php?id_productos_fabricados=' . $reg['id_productos_fabricados'] . '">Eliminar</a></td>';
  echo '</tr>';
}
//añadir un enlace para dar de alta un nuevo producto, para generar un reporte y para busqueda
echo '<tr>
        <td colspan="6">
          <a href="frm_fabricados.php">Alta de un Nuevo Producto?</a> | 
          <a href="reporte_productos.php">Reporte de Productos</a>
          <a href="busqueda.php">Búsqueda de Productos</a>
        </td>
      </tr>';

echo '</table>';

$mysql->close();
?>

