<?php
// Añadir estilo CSS a la página
echo "<link rel='stylesheet' href='estilolistado.css' type='text/css'>";

// Poner título "Búsqueda de Productos" en la página con CSS
echo '<h2>Búsqueda de Productos</h2>';

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");

if ($mysql->connect_error) {
  die("Problemas con la conexión a la base de datos");
}

// Obtener el valor de búsqueda (si se ha proporcionado)
$search_term = isset($_GET['search']) ? $mysql->real_escape_string($_GET['search']) : '';

// Crear la consulta SQL para obtener los productos
$sql = "SELECT pf.id_productos_fabricados, pf.productos_fabricados_cant_disponible, pf.productos_fabricados_stock_minimo, tp.tipo_productos_nombre
        FROM productos_fabricados pf
        JOIN tipo_productos tp ON pf.rela_productos = tp.id_tipo_productos";

// Si hay un término de búsqueda, modificar la consulta para buscar por el nombre del tipo de producto o el ID
if ($search_term != '') {
    $sql .= " WHERE pf.id_productos_fabricados LIKE '%$search_term%' OR tp.tipo_productos_nombre LIKE '%$search_term%'";
}

$registros = $mysql->query($sql) or die($mysql->error);

// Formulario de búsqueda
echo '<form method="get" action="busqueda.php">
        <input type="text" name="search" placeholder="Buscar por ID o Tipo de Producto" value="' . $search_term . '">
        <input type="submit" value="Buscar">
      </form>';

echo '<table>';
echo '<tr>
        <th>ID</th>
        <th>Cantidad Disponible</th>
        <th>Stock Mínimo</th>
        <th>Producto</th>
        <th>Modificar</th>
        <th>Eliminar</th>
      </tr>';

// Mostrar los resultados de búsqueda
if ($registros->num_rows > 0) {
    while ($reg = $registros->fetch_array()) {
        echo '<tr>';
        echo '<td>' . $reg['id_productos_fabricados'] . '</td>';
        echo '<td>' . $reg['productos_fabricados_cant_disponible'] . '</td>';
        echo '<td>' . $reg['productos_fabricados_stock_minimo'] . '</td>';
        echo '<td>' . $reg['tipo_productos_nombre'] . '</td>';
        echo '<td><a href="frm_modificar.php?id_productos_fabricados=' . $reg['id_productos_fabricados'] . '">Modificar</a></td>';
        echo '<td><a href="baja_fabricados.php?id_productos_fabricados=' . $reg['id_productos_fabricados'] . '">Eliminar</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">No se encontraron productos que coincidan con la búsqueda.</td></tr>';
}

echo '</table>';

$mysql->close();
?>

