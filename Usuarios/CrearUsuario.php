<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Productos/estiloscrear.css">
</head>
<body>
   
    
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

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

        <form action="registrousuario.php" method="post" onsubmit="return validar()">

            <h2>Bienvenido</h2>

            <label>Carnet de Identidad</label>
            <input type="text" placeholder="CARNET IDENTIDAD" name="CI" id="CI" >

            <label>Nombre</label>
            <input type="text" placeholder="NOMBRE(s)" name="Nombre" id="Nombre" >

            <label>Dirección</label>
            <input type="text" placeholder="DIRECCIÓN" name="Direccion" id="Direccion">

            <label>Número de Celular</label>
            <input type="number" placeholder="NÚMERO DE CELULAR" name="Numero" id="Numero">

            <label>Rol</label>
            <input type="text" placeholder="ROL" name="Rol" id="Rol">

            <label>Estado</label>
            <input type="text" placeholder="ESTADO" name="Estado" id="Estado">

            <input class="button" type="submit" value="Registrar">

        </form>

    </div>


</body>
</html>
