<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estilofrmfabric.css' type='text/css'>";
// Obtener los datos del formulario
$id_productos_fabricados = $_POST['id_productos_fabricados'];
$productos_fabricados_cant_disponible = $_POST['productos_fabricados_cant_disponible'];
$productos_fabricados_stock_minimo = $_POST['productos_fabricados_stock_minimo'];
$rela_productos = $_POST['rela_productos'];

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
if ($mysql->connect_error) {
    die("Problemas con la conexión a la base de datos");
}

// Realizar la actualización
$query = "UPDATE productos_fabricados 
          SET productos_fabricados_cant_disponible = $productos_fabricados_cant_disponible,
              productos_fabricados_stock_minimo = $productos_fabricados_stock_minimo,
              rela_productos = $rela_productos
          WHERE id_productos_fabricados = $id_productos_fabricados";

if ($mysql->query($query) === TRUE) {
    echo "Producto fabricado modificado correctamente";
} else {
    echo "Error al modificar el producto fabricado: " . $mysql->error;
}

$mysql->close();
?>
