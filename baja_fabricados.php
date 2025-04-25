<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estilofrmfabric.css' type='text/css'>";
// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");

if ($mysql->connect_error) {
  die("Problemas con la conexión a la base de datos");
}

// Verificar si se ha recibido el ID del producto
if (isset($_GET['id_productos_fabricados'])) {
  $id = $_GET['id_productos_fabricados'];

  // Realizar la consulta para eliminar el producto fabricado
  $query = "DELETE FROM productos_fabricados WHERE id_productos_fabricados = $id";
  if ($mysql->query($query)) {
    // Redirigir al listado después de eliminar
    header("Location: listado_fabricados.php"); 
    exit();
  } else {
    echo "Error al eliminar el producto: " . $mysql->error;
  }
} else {
  echo "Producto no encontrado.";
}

$mysql->close();
?>
