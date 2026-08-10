
<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli(
    $servidor,
    $usuario,
    $contrasena,
    $bd
);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de administracion</title>
      <link rel="stylesheet" href="estilos/estilosadmin.css">
</head>
<body>
  

<?php

session_start();



$sql = "SELECT * FROM pedidos ORDER BY id DESC";

$pedidos = mysqli_query($conn, $sql);

?>

<?php include "header.php"; ?>




<h1>
    Bienvenido, <?php echo $_SESSION['Nombre']; ?>
</h1>

<p>
    Panel de administración
</p>


<section class="stats">

    <div class="card">

        <img
            src="imagenes/carrito-de-compras.png"
            alt=""
        >

        <h2>
            <?php echo mysqli_num_rows($pedidos); ?>
        </h2>

        <p>
            Pedidos realizados
        </p>

    </div>


    <div class="card">

        <a href="Productos/leerproductos.php">

            <img
                src="imagenes/inventario-disponible.png"
                alt=""
            >

            <h2>
                18
            </h2>

            <p>
                Productos registrados
            </p>

        </a>

    </div>


    <div class="card">

        <a href="Usuarios/leerusuario.php">

            <img
                src="imagenes/nueva-cuenta.png"
                alt=""
            >

            <h2>32</h2>

            <p>Usuarios registrados</p>

        </a>

    </div>


    <div class="card">

        <img
            src="imagenes/dinero.png"
            alt=""
        >

        <h2>47</h2>

        <p> Ventas realizadas</p>

    </div>

</section>


<div class="content-grid">


    <section class="panel">

        <div class="panel-title">

            <img
                src="imagenes/carrito-de-compras.png"
                alt=""
            >

            <h2>
                Pedidos recientes
            </h2>

        </div>


        <div class="pedidos">

            <?php

            if (mysqli_num_rows($pedidos) > 0) {

                while ($pedido = mysqli_fetch_assoc($pedidos)) {

                    $idPedido = $pedido['id'];

                    $sqlProductos = "
                        SELECT *
                        FROM carrito
                        INNER JOIN productos
                        ON carrito.productos_Codigo = productos.Codigo
                        WHERE carrito.pedidos_id = '$idPedido'
                    ";

                    $productosPedido =
                        mysqli_query(
                            $conn,
                            $sqlProductos
                        );

            ?>

                <div class="pedido-card">


                    <div class="pedido-info">

                        <h3>
                            #<?php echo str_pad(
                                $pedido['id'],
                                4,
                                '0',
                                STR_PAD_LEFT
                            ); ?>
                        </h3>

                        <h4>
                            <?php echo $pedido['Nombre']; ?>
                        </h4>

                        <p>
                            Fecha:
                            <?php echo $pedido['Fecha']; ?>
                        </p>

                        <p>
                            Estado:
                            <?php echo $pedido['Estado']; ?>
                        </p>

                        <p>
                            Vendedor:
                            <?php echo $pedido['NombreVendedor']; ?>
                        </p>

                    </div>


                    <div class="pedido-productos">

                        <h4>
                            Productos
                        </h4>


                        <?php

                        if (
                            mysqli_num_rows(
                                $productosPedido
                            ) > 0
                        ) {

                            while (
                                $producto =
                                mysqli_fetch_assoc(
                                    $productosPedido
                                )
                            ) {

                        ?>

                            <p>

                                <?php echo
                                    $producto['NombreProducto'];
                                ?>

                                x<?php echo
                                    $producto['Cantidad'];
                                ?>

                            </p>

                        <?php

                            }

                        } else {

                        ?>

                            <p>
                                Sin productos
                            </p>

                        <?php } ?>

                    </div>


                    <div class="acciones">

                        <a
                            href="Pedidos/leerpedido.php?id=<?php echo $pedido['id']; ?>"
                        >

                            <img
                                src="imagenes/ojo-abierto.png"
                                alt="Ver"
                            >

                        </a>


                        <a
                            href="Pedidos/editarpedido.php?id=<?php echo $pedido['id']; ?>"
                        >

                            <img
                                src="imagenes/editarr.png"
                                alt="Editar"
                            >

                        </a>

                    </div>


                </div>

            <?php

                }

            } else {

            ?>

                <p>
                    No hay pedidos registrados.
                </p>

            <?php } ?>

        </div>


        <a
            class="btn"
            href="Pedidos/crearpedido.php"
        >
            Añadir pedidos +
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

                <img
                    src="imagenes/insignia.png"
                    alt=""
                >

                <h2>
                    Top ventas
                </h2>

            </div>


            <?php

            $sqlVentas = "
                SELECT *
                FROM carrito
                INNER JOIN productos
                ON carrito.productos_Codigo = productos.Codigo
                ORDER BY carrito.Cantidad DESC
                LIMIT 5
            ";

            $topVentas =
                mysqli_query(
                    $conn,
                    $sqlVentas
                );

            ?>


            <?php

            if (
                mysqli_num_rows($topVentas) > 0
            ) {

                while (
                    $venta =
                    mysqli_fetch_assoc($topVentas)
                ) {

            ?>

                <div class="venta-card">

                    <div>

                        <h3>
                            <?php echo
                                $venta['NombreProducto'];
                            ?>
                        </h3>

                        <p>
                            <?php echo
                                $venta['Cantidad'];
                            ?>
                            vendidos
                        </p>

                    </div>


                    <?php if (
                        !empty(
                            $venta['Imagen']
                        )
                    ) { ?>

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

            <?php

                }

            } else {

            ?>

                <p>
                    Todavía no hay ventas.
                </p>

            <?php } ?>

        </section>


    </aside>

</div>


<section class="acciones-panel">

    <div class="acciones-grid">


        <div class="accion-card">

            <img
                src="imagenes/configuracion.png"
                alt=""
            >

            <h3>
                Configuración
            </h3>

        </div>


        <a href="Usuarios/cerrarsesion.php">

            <div class="accion-card">

                <img
                    src="imagenes/cerrar-sesion.png"
                    alt=""
                >

                <h3>
                    Cerrar Sesión
                </h3>

            </div>

        </a>


    </div>

</section>


</body>
</html>