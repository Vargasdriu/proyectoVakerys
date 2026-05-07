<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
</head>
<body>

 <div class="tra">
  <form action="registroproducto.php" method="post">
    <h2>Nuevo Producto</h2>

    <label>Ingrese:</label>
    <input type="text" placeholder="CODIGO" name="Codigo" required><br>

    <input type="text" placeholder="NOMBRE" name="NombreProducto" required><br>

    <input type="number" placeholder="PRECIO DE VENTA" name="PrecioProducto" required><br>

    <input type="text" placeholder="DETALLE" name="DetalleProducto" required><br>

    <input type="number" placeholder="COSTO" name="CostoProducto" required><br>

    <input type="number" placeholder="STOCK" name="Stock" required><br>

    <input class="buttom" type="submit" value="Registrar">

  </form>
</div>
</body>
</html>
