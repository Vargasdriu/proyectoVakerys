<?php
session_start();
$nombre = $_SESSION['Nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vakery's Dashboard</title>

  <link rel="stylesheet" href="estilos/admin.css">

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway:wght@400;500;700&display=swap" rel="stylesheet">
 <style>
  a{
    text-decoration:none;
  }
 </style>
</head>

<body>



  <?php include 'header.php'; ?>
  

  <main class="dashboard">

    <div class="saludo">
    <h1>¡Hola, <?php echo $nombre; ?>!</h1>
    <p>Bienvenido/a de nuevo.</p>
</div>

    <section class="stats">
      <a href="">
      <div  class="card">
        <img src="imagenes/dinero.png" alt="">
        <h2>Bs. 450</h2>
        <p>Ventas de hoy</p>
      </div>
      </a>
      <a href="">
      <div class="card">
        <img src="imagenes/carrito-de-compras.png" alt="">
        <h2>25</h2>
        <p>Pedidos activos</p>
      </div>
      </a>

      <a href="Usuarios/leerusuario.php">
      <div class="card">
        <img src="imagenes/nueva-cuenta.png" alt="">
        <h2>34</h2>
        <p>Nuevos usuarios</p>
      </div>
      </a>

      <a href="Productos/leerproductos.php">
      <div class="card">
        <img src="imagenes/galleta.png" alt="">
        <h2>256</h2>
        <p>Productos</p>
      </div>
      </a>
    </section>

    

    <section class="content-grid">

      
      <section class="panel pedidos">

        <div class="panel-title">
          <img src="imagenes/carrito-de-compras.png" alt="">
          <h2>Pedidos recientes</h2>
        </div>

        <div class="pedido-card">

          <img class="producto-img" src="imagenes/applepie.png" alt="">

          <div class="pedido-info">
            <h3>#0124</h3>
            <h4>Antonella Revollo</h4>
            <p>x1 Chocolate Chip Cookie</p>
          </div>

          <div class="acciones">
            <img src="imagenes/ojo-abierto.png" alt="">
            <img src="imagenes/editarr.png" alt="">
          </div>

        </div>

        <div class="pedido-card">

          <img class="producto-img" src="imagenes/cookie.png" alt="">

          <div class="pedido-info">
            <h3>#0125</h3>
            <h4>Camila Flores</h4>
            <p>x2 Cookies</p>
          </div>

          <div class="acciones">
            <img src="imagenes/ojo-abierto.png" alt="">
            <img src="imagenes/editar.png" alt="">
          </div>

        </div>

        <div class="pedido-card">

          <img class="producto-img" src="imagenes/browniesolo.png" alt="">

          <div class="pedido-info">
            <h3>#0126</h3>
            <h4>Diego Rojas</h4>
            <p>x1 Brownie</p>
          </div>

          <div class="acciones">
            <img src="imagenes/ojo-abierto.png" alt="">
            <img src="imagenes/editar.png" alt="">
          </div>

        </div>

        <a class="btn" href="Pedidos/verpedidos.php">
          Ver todos los pedidos
        </a>

      </section>

     

      <aside class="sidebar">

        

        <section class="panel inventario">

          <div class="panel-title">
            <img src="imagenes/inventario-disponible.png" alt="">
            <h2>Inventario</h2>
          </div>

          <div class="inventario-item">
            <img src="imagenes/applepie.png" alt="">
            <span>Apple Pie</span>
            <span>24 en stock</span>
          </div>

          <div class="inventario-item">
            <img src="imagenes/cookie.png" alt="">
            <span>Cookie</span>
            <span>24 en stock</span>
          </div>

          <div class="inventario-item">
            <img src="imagenes/browniesolo.png" alt="">
            <span>Brownie</span>
            <span>24 en stock</span>
          </div>

          <a class="btn" href="Productos/leerproductos.php">
            Actualizar inventario
          </a>

        </section>

        

        <section class="panel topventas">

          <div class="panel-title">
            <img src="imagenes/insignia.png" alt="">
            <h2>Top ventas</h2>
          </div>

          <div class="venta-card">

            <div>
              <h3>Cookie</h3>
              <p>20 en stock</p>
            </div>

            <img src="imagenes/cookie.png" alt="">

          </div>

          <div class="venta-card">

            <div>
              <h3>Apple Pie</h3>
              <p>12 en stock</p>
            </div>

            <img src="imagenes/applepie.png" alt="">

          </div>

        </section>

      </aside>

    </section>

 
    <section class="panel acciones-panel">

      <div class="panel-title">
        <img src="imagenes/configuracion.png" alt="">
        <h2>Acciones rápidas</h2>
      </div>

      <div class="acciones-grid">

        <div class="accion-card">
          <img src="imagenes/inventario-disponible.png" alt="">
          <h3>Añadir productos</h3>
        </div>
        <a href="Usuarios/leerusuario.php">
        <div class="accion-card">
          <img src="imagenes/nueva-cuenta.png" alt="">
          <h3>Ver usuarios</h3>
        </div>
        </a>

      

        <div class="accion-card">
          <img src="imagenes/configuracion.png" alt="">
          <h3>Configuración</h3>
        </div>
        <a href="Usuarios/cerrarsesion.php">
          <div class="accion-card">
          <img src="imagenes/cerrar-sesion.png" alt="">
          <h3>Cerrar Sesión</h3>
        </div>
      </div>
</a>
    </section>

  </main>

 

<?php include 'footer.php'; ?>

</body>
</html>
