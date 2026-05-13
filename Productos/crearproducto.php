<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
   <link rel="stylesheet" href="estiloscrear.css">   
</head>
<body>
  <video autoplay muted loop>
    <source src="http://localhost/vakerys/imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

<form action="registroproducto.php" method="post">

<h2>Nuevo Producto</h2>

<label>Ingrese:</label>

<input type="text" placeholder="CODIGO" name="Codigo" required>

<input type="text" placeholder="NOMBRE" name="NombreProducto" required>

<input type="number" placeholder="PRECIO DE VENTA" name="PrecioProducto" required>

<input type="text" placeholder="DETALLE" name="DetalleProducto" required>

<input type="number" placeholder="COSTO" name="CostoProducto" required>

<input type="number" placeholder="STOCK" name="Stock" required>

<input class="buttom" type="submit" value="Registrar">

</form>

</div>

</body>
</html>
