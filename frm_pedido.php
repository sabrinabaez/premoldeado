<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Pedido</title>
</head>
<body>
    <h2>Formulario de Registro de Pedido</h2>

    <!-- Mostrar datos del cliente seleccionado -->
    <?php
    // Si el cliente ha sido seleccionado o registrado, continuamos con el formulario
    if (isset($_GET['cliente_id'])) {
        $cliente_id = $_GET['cliente_id'];
        // Obtener los detalles del cliente de la base de datos
        $mysql = new mysqli("localhost", "root", "", "sistema_premoldeado");

        if ($mysql->connect_error) {
            die("Problemas con la conexión a la base de datos: " . $mysql->connect_error);
        }

        $sql = "SELECT * FROM clientes WHERE id_cliente = $cliente_id";
        $resultado = $mysql->query($sql);

        if ($resultado->num_rows > 0) {
            $cliente = $resultado->fetch_assoc();
            echo "<h3>Cliente Seleccionado:</h3>";
            echo "Nombre: " . $cliente['cliente_nombre'] . "<br>";
            echo "<input type='hidden' name='rela_clientes' value='" . $cliente['id_cliente'] . "'>";
        }

        $mysql->close();
    }
    ?>

    <!-- Formulario de Pedido -->
    <form method="POST" action="insert_pedido.php">
        <!-- Fecha de Pedido -->
        <label for="pedido_fecha">Fecha del Pedido:</label>
        <input type="date" name="pedido_fecha" id="pedido_fecha" required><br>

        <!-- Estado del Pedido -->
        <label for="pedido_estado">Estado del Pedido:</label>
        <select name="pedido_estado" id="pedido_estado" required>
            <option value="1">Pendiente</option>
            <option value="2">En Proceso</option>
            <option value="3">Completado</option>
        </select><br>

        <!-- Total del Pedido -->
        <label for="pedido_total">Total del Pedido:</label>
        <input type="number" name="pedido_total" id="pedido_total" required><br>

        <!-- Método de Pago -->
        <label for="rela_metodos_pago">Método de Pago:</label>
        <select name="rela_metodos_pago" id="rela_metodos_pago" required>
            <option value="1">Efectivo</option>
            <option value="2">Tarjeta de Crédito</option>
            <option value="3">Transferencia</option>
        </select><br>

        <!-- Forma de Entrega -->
        <label for="rela_forma_entrega">Forma de Entrega:</label>
        <select name="rela_forma_entrega" id="rela_forma_entrega" required>
            <option value="1">Retiro en Tienda</option>
            <option value="2">Envío a Domicilio</option>
        </select><br>

        <input type="submit" value="Registrar Pedido">
    </form>
</body>
</html>
