<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BUSQUEDA</title>
</head>

<body>

  <?php
  $mysql = new mysqli("localhost", "root", "", "proyecto");
  if ($mysql->connect_error)
    die("Problemas con la conexi�n a la base de datos");

  $registros = $mysql->query("select *
                                  from rubros join productos  on  rela_rubros=id_rubros
                                  where id_producto=$_REQUEST[id_producto]") or
    die($mysql->error);

  if ($reg = $registros->fetch_array()) {
    echo 'Descripci�n:' . $reg['producto_descripcion'] . '<br>';
    echo 'Precio:' . $reg['producto_precio'] . '<br>';
    echo 'Rubro:' . $reg['rubros_descripcion'] . '<br>';
  } else
    echo 'No existe el producto con ese rubro';

  $mysql->close();

  ?>
</body>

</html>