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

session_start();

$sql = "SELECT * FROM pedidos ORDER BY id DESC";
$pedidos = mysqli_query($conn, $sql);

$sqlProductosRegistrados = "SELECT COUNT(*) AS total FROM productos";
$resProductosRegistrados = mysqli_query($conn, $sqlProductosRegistrados);
$productosRegistrados = 0;

if ($resProductosRegistrados) {
    $datosProductos = mysqli_fetch_assoc($resProductosRegistrados);
    $productosRegistrados = $datosProductos['total'];
}

$sqlUsuarios = "SELECT COUNT(*) AS total FROM GestionDeUsuarios";
$resUsuarios = mysqli_query($conn, $sqlUsuarios);
$usuariosRegistrados = 0;

if ($resUsuarios) {
    $datosUsuarios = mysqli_fetch_assoc($resUsuarios);
    $usuariosRegistrados = $datosUsuarios['total'];
}

$sqlVentasRealizadas = "SELECT COUNT(*) AS total FROM ventas";
$resVentasRealizadas = mysqli_query($conn, $sqlVentasRealizadas);
$ventasRealizadas = 0;

if ($resVentasRealizadas) {
    $datosVentas = mysqli_fetch_assoc($resVentasRealizadas);
    $ventasRealizadas = $datosVentas['total'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Panel de administracion</title>

    <link
        rel="stylesheet"
        href="estilos/estilosadmin.css"
    >

</head>

<body>

<?php include "header.php"; ?>

<h1>
    Bienvenido, <?php echo htmlspecialchars($_SESSION['Nombre']); ?>
</h1>

<br>

<p>
    Panel de administración
</p>

<br>

<section class="stats">

    <a href="Pedidos/leerpedido.php">

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

    </a>

    <div class="card">

        <a href="Productos/leerproductos.php">

            <img
                src="imagenes/inventario-disponible.png"
                alt=""
            >

            <h2>
                <?php echo $productosRegistrados; ?>
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

            <h2>
                <?php echo $usuariosRegistrados; ?>
            </h2>

            <p>
                Usuarios registrados
            </p>

        </a>

    </div>

    <div class="card">

        <a href="Ventas/leerventa.php">

            <img
                src="imagenes/dinero.png"
                alt=""
            >

            <h2>
                <?php echo $ventasRealizadas; ?>
            </h2>

            <p>
                Ventas realizadas
            </p>

        </a>

    </div>

    <div class="card">

        <a href="Comentarios/comentarios.php">

            <img
                src="imagenes/comentario.webp"
                alt=""
            >

            <h2>
                0
            </h2>

            <p>
                Comentarios
            </p>

        </a>

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

                    $sqlProductosPedido = "
                        SELECT *
                        FROM carrito
                        INNER JOIN productos
                        ON carrito.productos_Codigo = productos.Codigo
                        WHERE carrito.pedidos_id = '$idPedido'
                    ";

                    $productosPedido = mysqli_query(
                        $conn,
                        $sqlProductosPedido
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
                                <?php echo htmlspecialchars($pedido['Nombre']); ?>
                            </h4>

                            <p>
                                Fecha:
                                <?php echo htmlspecialchars($pedido['Fecha']); ?>
                            </p>

                            <p>
                                Estado:
                                <?php echo htmlspecialchars($pedido['Estado']); ?>
                            </p>

                            <p>
                                Vendedor:
                                <?php echo htmlspecialchars($pedido['NombreVendedor']); ?>
                            </p>

                        </div>

                        <div class="pedido-productos">

                            <h4>
                                Productos
                            </h4>

                            <?php

                            if (
                                mysqli_num_rows($productosPedido) > 0
                            ) {

                                while (
                                    $producto =
                                    mysqli_fetch_assoc($productosPedido)
                                ) {

                            ?>

                                    <p>

                                        <?php echo htmlspecialchars(
                                            $producto['NombreProducto']
                                        ); ?>

                                        x<?php echo htmlspecialchars(
                                            $producto['Cantidad']
                                        ); ?>

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
                                href="Pedidos/actualizarpedido.php?id=<?php echo $pedido['id']; ?>"
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

        <br><br>

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

                <img
                    src="imagenes/inventario-disponible.png"
                    alt=""
                >

                <h2>
                    Inventario
                </h2>

            </div>

            <?php

            $sqlInventario = "
                SELECT
                    p.Codigo,
                    p.NombreProducto,
                    p.Stock,
                    (
                        SELECT i.Imagen
                        FROM imagenes i
                        WHERE i.CodigoProducto = p.Codigo
                        LIMIT 1
                    ) AS Imagen
                FROM productos p
                ORDER BY p.NombreProducto ASC
                LIMIT 3
            ";

            $inventario = mysqli_query(
                $conn,
                $sqlInventario
            );

            ?>

            <?php if ($inventario && mysqli_num_rows($inventario) > 0) { ?>

                <?php while ($producto = mysqli_fetch_assoc($inventario)) { ?>

                    <div class="inventario-item">

                        <?php if (!empty($producto['Imagen'])) { ?>

                            <img
                                src="Productos/imagenes/<?php echo htmlspecialchars($producto['Imagen']); ?>"
                                alt="<?php echo htmlspecialchars($producto['NombreProducto']); ?>"
                            >

                        <?php } else { ?>

                            <img
                                src="imagenes/galleta.png"
                                alt="Producto"
                            >

                        <?php } ?>

                        <span>
                            <?php echo htmlspecialchars($producto['NombreProducto']); ?>
                        </span>

                        <span>
                            <?php echo htmlspecialchars($producto['Stock']); ?> en stock
                        </span>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <p>
                    No hay productos registrados.
                </p>

            <?php } ?>

            <a
                class="btn"
                href="Productos/leerproductos.php"
            >
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
                SELECT
                    p.Codigo,
                    p.NombreProducto,
                    SUM(c.Cantidad) AS CantidadVendida,
                    (
                        SELECT i.Imagen
                        FROM imagenes i
                        WHERE i.CodigoProducto = p.Codigo
                        LIMIT 1
                    ) AS Imagen
                FROM carrito c
                INNER JOIN productos p
                    ON c.productos_Codigo = p.Codigo
                INNER JOIN pedidos pe
                    ON c.pedidos_id = pe.id
                WHERE pe.Estado = 'Finalizado'
                GROUP BY
                    p.Codigo,
                    p.NombreProducto
                ORDER BY CantidadVendida DESC
                LIMIT 3
            ";

            $topVentas = mysqli_query(
                $conn,
                $sqlVentas
            );

            ?>

            <?php if ($topVentas && mysqli_num_rows($topVentas) > 0) { ?>

                <?php while ($venta = mysqli_fetch_assoc($topVentas)) { ?>

                    <div class="venta-card">

                        <div>

                            <h3>
                                <?php echo htmlspecialchars(
                                    $venta['NombreProducto']
                                ); ?>
                            </h3>

                            <p>
                                <?php echo htmlspecialchars(
                                    $venta['CantidadVendida']
                                ); ?>

                                vendidos
                            </p>

                        </div>

                        <?php if (!empty($venta['Imagen'])) { ?>

                            <img
                                src="Productos/imagenes/<?php echo htmlspecialchars($venta['Imagen']); ?>"
                                alt="<?php echo htmlspecialchars($venta['NombreProducto']); ?>"
                            >

                        <?php } else { ?>

                            <img
                                src="imagenes/galleta.png"
                                alt="Producto"
                            >

                        <?php } ?>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <p>
                    Todavía no hay ventas.
                </p>

            <?php } ?>

        </section>

    </aside>

</div>

<section class="acciones-panel">

    <div class="acciones-grid">

        <a href="reportes.php">

            <div class="accion-card">

                <img
                    src="imagenes/grafico-de-barras.png"
                    alt=""
                >

                <h3>
                    Ver reportes
                </h3>

            </div>

        </a>

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