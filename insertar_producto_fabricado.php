<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estilofrmfabric.css' type='text/css'>";

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
if ($mysql->connect_error) {
    die("Conexión fallida: " . $mysql->connect_error);
}

// Obtener los datos del formulario
$productos_fabricados_cant_disponible = $_POST['productos_fabricados_cant_disponible'];
$productos_fabricados_stock_minimo = $_POST['productos_fabricados_stock_minimo'];
$rela_productos = $_POST['rela_productos'];

// Realizar la inserción en la tabla productos_fabricados
$query = "INSERT INTO productos_fabricados (productos_fabricados_cant_disponible, productos_fabricados_stock_minimo, rela_productos)
          VALUES ('$productos_fabricados_cant_disponible', '$productos_fabricados_stock_minimo', '$rela_productos')";

if ($mysql->query($query) === TRUE) {
    echo "Producto fabricado registrado correctamente.";
} else {
    echo "Error al registrar el producto fabricado: " . $mysql->error;
}

// Cerrar la conexión
$mysql->close();
?>
