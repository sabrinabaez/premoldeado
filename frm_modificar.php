<?php
//añadir estilo css a la pagina
echo "<link rel='stylesheet' href='estilofrmfabric.css' type='text/css'>";

// Obtener el ID del producto fabricado a modificar
$id_productos_fabricados = $_GET['id_productos_fabricados'];

// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
if ($mysql->connect_error) {
    die("Problemas con la conexión a la base de datos");
}

// Obtener los datos del producto fabricado
$query = "SELECT pf.*, tp.tipo_productos_nombre 
          FROM productos_fabricados pf
          JOIN productos p ON pf.rela_productos = p.id_productos
          JOIN tipo_productos tp ON p.rela_tipo_productos = tp.id_tipo_productos
          WHERE pf.id_productos_fabricados = $id_productos_fabricados";
$resultado = $mysql->query($query);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "Producto no encontrado";
    exit;
}
?>

<form method="POST" action="update_fabricados.php">
    <input type="hidden" name="id_productos_fabricados" value="<?php echo $producto['id_productos_fabricados']; ?>">

    <label for="productos_fabricados_cant_disponible">Cantidad Disponible:</label>
    <input type="number" name="productos_fabricados_cant_disponible" id="productos_fabricados_cant_disponible" 
           value="<?php echo $producto['productos_fabricados_cant_disponible']; ?>" required><br>

    <label for="productos_fabricados_stock_minimo">Stock Mínimo:</label>
    <input type="number" name="productos_fabricados_stock_minimo" id="productos_fabricados_stock_minimo" 
           value="<?php echo $producto['productos_fabricados_stock_minimo']; ?>" required><br>

    <label for="rela_productos">Producto:</label>
    <select name="rela_productos" id="rela_productos" required>
        <?php
        // Hacer una consulta para obtener los productos y sus tipos
        $query = "SELECT p.id_productos, tp.tipo_productos_nombre
                  FROM productos p
                  JOIN tipo_productos tp ON p.rela_tipo_productos = tp.id_tipo_productos";
        $resultado = $mysql->query($query);

        // Cargar productos con el nombre del tipo de producto en el select
        while ($row = $resultado->fetch_assoc()) {
            $selected = $row['id_productos'] == $producto['rela_productos'] ? 'selected' : '';
            echo "<option value='" . $row['id_productos'] . "' $selected>" . $row['tipo_productos_nombre'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Modificar Producto Fabricado">
</form>

<?php
$mysql->close();
?>
