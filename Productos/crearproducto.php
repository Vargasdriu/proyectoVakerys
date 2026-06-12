<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
   <link rel="stylesheet" href="estiloscrear.css">   
</head>
<body>
  <header class="main-header">

    <div class="header-logo">
      <img src="../imagenes/logo.png" alt="Vakery's">
    </div>

    <label for="btn-nav" class="btn-nav">
      <img src="../imagenes/menu.png" alt="Menu">
    </label>

    <input type="checkbox" id="btn-nav">

    <nav>

      <ul class="menu">
        <li><a href="../paginadeinicio.html">Inicio</a></li>
        <li><a href="#">Iniciar sesión</a></li>
        <li><a href="../paginaproductos.html">Productos</a></li>
        <li><a href="#">Promociones</a></li>
        <li><a href="../sobrevakerys1.html">Sobre Vakery's</a></li>
        <li><a href="../paginaadmin.html">Página Administrador</a></li>
      <li><a href="paginavendedor.html">Página Vendedor</a></li>
      </ul>

    </nav>

  </header>
  <video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

<form action="registroproducto.php" method="post">

<h2>Nuevo Producto</h2>

<label>Ingrese:</label>

<input type="text" placeholder="CODIGO" name="Codigo" id="Codigo" >
<input type="text" placeholder="NOMBRE" name="NombreProducto" id="Producto" >
<input type="number" placeholder="PRECIO DE VENTA" name="PrecioProducto" id="Precio" >
<input type="text" placeholder="DETALLE" name="DetalleProducto" id="Detalle" >
<input type="number" placeholder="COSTO" name="CostoProducto" id="Costo" >
<input type="number" placeholder="STOCK" name="Stock" id="Stock" >
<input class="buttom" type="submit" value="Registrar">

</form>

</div>

</body>
</html>
