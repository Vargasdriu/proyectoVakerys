
<?php

$conexion = mysqli_connect("localhost", "root", "", "vakerysss");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");

session_start();

$nombre = $_SESSION['Nombre'];


$sqlVentasHoy = "
    SELECT COALESCE(SUM(v.costoTotal), 0) AS total
    FROM ventas v
    INNER JOIN pedidos p ON v.pedidos_id = p.id
    WHERE p.Fecha = CURDATE()
";

$resultVentasHoy = mysqli_query($conexion, $sqlVentasHoy);
$ventasHoy = mysqli_fetch_assoc($resultVentasHoy)['total'];


$sqlPedidosActivos = "
    SELECT COUNT(*) AS total
    FROM pedidos
    WHERE Estado IS NULL
       OR Estado NOT IN ('Entregado', 'Cancelado')
";

$resultPedidosActivos = mysqli_query($conexion, $sqlPedidosActivos);
$pedidosActivos = mysqli_fetch_assoc($resultPedidosActivos)['total'];


$sqlUsuarios = "
    SELECT COUNT(*) AS total
    FROM clientes
";

$resultUsuarios = mysqli_query($conexion, $sqlUsuarios);
$totalUsuarios = mysqli_fetch_assoc($resultUsuarios)['total'];


$sqlProductosTotal = "
    SELECT COUNT(*) AS total
    FROM productos
";

$resultProductosTotal = mysqli_query($conexion, $sqlProductosTotal);
$totalProductos = mysqli_fetch_assoc($resultProductosTotal)['total'];


$sqlPedidos = "
    SELECT 
        p.id,
        p.Nombre,
        pr.NombreProducto,
        pr.Imagen,
        c.Cantidad
    FROM pedidos p
    INNER JOIN carrito c 
        ON p.id = c.pedidos_id
    INNER JOIN productos pr 
        ON c.productos_Codigo = pr.Codigo
    ORDER BY p.id DESC
    LIMIT 3
";

$pedidos = mysqli_query($conexion, $sqlPedidos);


$sqlProductos = "
    SELECT 
        NombreProducto,
        Stock,
        Imagen
    FROM productos
    ORDER BY Stock ASC
    LIMIT 3
";

$productos = mysqli_query($conexion, $sqlProductos);


$sqlTopVentas = "
    SELECT
        pr.NombreProducto,
        pr.Imagen,
        SUM(c.Cantidad) AS vendidos
    FROM carrito c
    INNER JOIN productos pr
        ON c.productos_Codigo = pr.Codigo
    GROUP BY pr.Codigo, pr.NombreProducto, pr.Imagen
    ORDER BY vendidos DESC
    LIMIT 2
";

$topVentas = mysqli_query($conexion, $sqlTopVentas);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="estilos/paginaadmin.css">
</head>

<body>

<div class="contenido">

  <div class="saludo">

    <h1>
      Bienvenido, <?php echo $_SESSION['Nombre']; ?>
    </h1>

    <p>
      Panel de administración
    </p>

  </div>


  <main class="dashboard">

    <?php include 'header.php'; ?>


    <section class="stats">

      <div class="card">
  <a href="Pedidos/leerpedido.php">
        <img src="imagenes/bolsa-de-la-compra.png" alt="">

        <h2>24</h2>

        <p>
          Pedidos realizados
        </p>
</a>
      </div>


      <div class="card">
        <a href="Productos/leerproductos.php">
        <img src="imagenes/inventario-disponible.png" alt="">

        <h2>18</h2>

        <p>
          Productos registrados
        </p>
        </a>
      </div>


      <div class="card">
        <a href="Usuarios/leerusuario.php">
        <img src="imagenes/nueva-cuenta.png" alt="">

        <h2>32</h2>

        <p>
          Usuarios registrados
        </p>
</a>
      </div>


      <div class="card">

        <img src="imagenes/dinero.png" alt="">

        <h2>47</h2>

        <p>
          Ventas realizadas
        </p>

      </div>

    </section>


    <div class="content-grid">


      <section class="panel">

        <div class="panel-title">

          <img src="imagenes/carrito-de-compras.png" alt="">

          <h2>
            Pedidos recientes
          </h2>

        </div>


        <div class="pedidos">

          <?php while ($pedido = mysqli_fetch_assoc($pedidos)) { ?>

            <div class="pedido-card">


              <?php if (!empty($pedido['Imagen'])) { ?>

                <img
                  class="producto-img"
                  src="<?php echo $pedido['Imagen']; ?>"
                  alt=""
                >

              <?php } else { ?>

                <img
                  class="producto-img"
                  src="imagenes/galleta.png"
                  alt=""
                >

              <?php } ?>


              <div class="pedido-info">

                <h3>
                  #<?php echo str_pad($pedido['id'], 4, '0', STR_PAD_LEFT); ?>
                </h3>

                <h4>
                  <?php echo $pedido['Nombre']; ?>
                </h4>

                <p>
                  x<?php echo $pedido['Cantidad']; ?>
                  <?php echo $pedido['NombreProducto']; ?>
                </p>

              </div>


              <div class="acciones">

                <a href="Pedidos/leerpedido.php?id=<?php echo $pedido['id']; ?>">
                  <img src="imagenes/ojo-abierto.png" alt="">
                </a>

                <a href="Pedidos/editarpedido.php?id=<?php echo $pedido['id']; ?>">
                  <img src="imagenes/editarr.png" alt="">
                </a>

              </div>


            </div>

          <?php } ?>

        </div>


        <a class="btn" href="Pedidos/crearpedido.php">
          Añadir pedidos +
        </a>

      </section>


      <aside class="sidebar">


        <section class="panel inventario">

          <div class="panel-title">

            <img src="imagenes/inventario-disponible.png" alt="">

            <h2>
              Inventario
            </h2>

          </div>


          <?php while ($producto = mysqli_fetch_assoc($productos)) { ?>

            <div class="inventario-item">


              <?php if (!empty($producto['Imagen'])) { ?>

                <img
                  src="<?php echo $producto['Imagen']; ?>"
                  alt=""
                >

              <?php } else { ?>

                <img
                  src="imagenes/galleta.png"
                  alt=""
                >

              <?php } ?>


              <span>
                <?php echo $producto['NombreProducto']; ?>
              </span>


              <span>
                <?php echo $producto['Stock']; ?> en stock
              </span>


            </div>

          <?php } ?>


          <a class="btn" href="Productos/leerproductos.php">
            Actualizar inventario
          </a>

        </section>


        <section class="panel topventas">

          <div class="panel-title">

            <img src="imagenes/insignia.png" alt="">

            <h2>
              Top ventas
            </h2>

          </div>


          <?php while ($venta = mysqli_fetch_assoc($topVentas)) { ?>

            <div class="venta-card">


              <div>

                <h3>
                  <?php echo $venta['NombreProducto']; ?>
                </h3>

                <p>
                  <?php echo $venta['vendidos']; ?> vendidos
                </p>

              </div>


              <?php if (!empty($venta['Imagen'])) { ?>

                <img
                  src="<?php echo $venta['Imagen']; ?>"
                  alt=""
                >

              <?php } else { ?>

                <img
                  src="imagenes/galleta.png"
                  alt=""
                >

              <?php } ?>


            </div>

          <?php } ?>


        </section>


      </aside>


    </div>


    <section class="acciones-panel">

      <div class="acciones-grid">


        <div class="accion-card">

          <img src="imagenes/configuracion.png" alt="">

          <h3>
            Configuración
          </h3>

        </div>


        <a href="Usuarios/cerrarsesion.php">

          <div class="accion-card">

            <img src="imagenes/cerrar-sesion.png" alt="">

            <h3>
              Cerrar Sesión
            </h3>

          </div>

        </a>


      </div>

    </section>


  </main>

</div>


<footer>

  <?php include 'footer.php'; ?>

</footer>


</body>

</html>
