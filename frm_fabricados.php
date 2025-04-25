<form method="POST" action="insertar_producto_fabricado.php">
    <label for="productos_fabricados_cant_disponible">Cantidad Disponible:</label>
    <input type="number" name="productos_fabricados_cant_disponible" id="productos_fabricados_cant_disponible" required><br>
    <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="estilofrmfabric.css" type="text/css">
</head>
    <label for="productos_fabricados_stock_minimo">Stock Mínimo:</label>
    <input type="number" name="productos_fabricados_stock_minimo" id="productos_fabricados_stock_minimo" required><br>

    <label for="rela_productos">Producto:</label>
    <select name="rela_productos" id="rela_productos" required>
        <?php
        // Conectar a la base de datos
        $mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");
        if ($mysql->connect_error) {
            die("Conexión fallida: " . $mysql->connect_error);
        }
        
        // Hacer una consulta para obtener los productos y sus tipos
        $query = "SELECT p.id_productos, tp.tipo_productos_nombre
                  FROM productos p
                  JOIN tipo_productos tp ON p.rela_tipo_productos = tp.id_tipo_productos";
        $resultado = $mysql->query($query);
        
        // Cargar productos con el nombre del tipo de producto en el select
        while ($row = $resultado->fetch_assoc()) {
            echo "<option value='" . $row['id_productos'] . "'>" . $row['tipo_productos_nombre'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Registrar Producto Fabricado">
</form>
