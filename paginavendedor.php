<?php

session_start();

$conn = new mysqli("localhost", "root", "", "vakerysss");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = isset($_SESSION['Nombre']) ? $_SESSION['Nombre'] : '';

$resTotalPedidos = $conn->query("
    SELECT COUNT(*) AS total
    FROM pedidos
    WHERE Estado IS NULL
    OR Estado NOT IN ('Aceptado', 'Cancelado')
");

$totalPedidosHoy = 0;

if ($resTotalPedidos) {
    $datosPedidos = $resTotalPedidos->fetch_assoc();
    $totalPedidosHoy = $datosPedidos['total'];
}

$resStockTotal = $conn->query("
    SELECT SUM(Stock) AS total_stock
    FROM productos
");

$stockTotal = 0;

if ($resStockTotal) {
    $datosStock = $resStockTotal->fetch_assoc();
    $stockTotal = $datosStock['total_stock'] ?? 0;
}

$sqlProductos = "
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
";

$resProductos = $conn->query($sqlProductos);

$sqlTopVentas = "
    SELECT
        p.Codigo,
        p.NombreProducto,
        SUM(c.Cantidad) AS total_vendido,
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
    GROUP BY p.Codigo, p.NombreProducto
    ORDER BY total_vendido DESC
    LIMIT 5
";

$resTopVentas = $conn->query($sqlTopVentas);

$sqlPedidos = "
    SELECT
        p.*,
        GROUP_CONCAT(
            CONCAT(pr.NombreProducto, ' x', c.Cantidad)
            SEPARATOR '<br>'
        ) AS resumen_productos,
        SUM(c.CostoTotal) AS total_calculado
    FROM pedidos p
    LEFT JOIN carrito c
        ON p.id = c.pedidos_id
    LEFT JOIN productos pr
        ON c.productos_Codigo = pr.Codigo
    WHERE p.Estado IS NULL
    OR p.Estado NOT IN ('Aceptado', 'Cancelado')
    GROUP BY p.id
    ORDER BY p.id DESC
";

$resPedidos = $conn->query($sqlPedidos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel Vendedor - Vakery's</title>

    <link rel="stylesheet" href="estilos/vendedor.css">

    <style>

        a {
            text-decoration: none;
            color: inherit;
        }

        .btn-atender {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #709775;
            color: #ffffff;
            padding: 13px 0;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 12px;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .btn-atender:hover {
            background-color: #afc194;
            color: #1f2d25;
            transform: scale(1.03);
        }

        .inventario {
            width: 90%;
            max-width: 540px;
            margin: 30px auto;
            padding: 28px;
            background: #ffffff;
            border: 3px solid #709775;
            border-radius: 25px;
            box-sizing: border-box;
        }

        .inventario-titulo {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 28px;
        }

        .inventario-titulo img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .inventario-titulo h1 {
            margin: 0;
            font-size: 30px;
            color: #102f24;
        }

        .productos-inventario {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .producto-inventario {
            display: grid;
            grid-template-columns: 90px 1fr auto;
            align-items: center;
            min-height: 110px;
            padding: 10px 18px;
            background: #f5f5f5;
            border-radius: 17px;
            box-sizing: border-box;
        }

        .producto-imagen {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .producto-imagen img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .producto-nombre p {
            margin: 0;
            font-size: 16px;
            color: #102f24;
        }

        .producto-stock p {
            margin: 0;
            font-size: 16px;
            color: #102f24;
            white-space: nowrap;
        }

        .btn-inventario {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 14px 0;
            text-align: center;
            background: #709775;
            color: white;
            border-radius: 12px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .btn-inventario:hover {
            background: #afc194;
            color: #1f2d25;
        }

        .top-ventas {
            width: 90%;
            max-width: 540px;
            margin: 30px auto;
            padding: 28px;
            background: #ffffff;
            border: 3px solid #709775;
            border-radius: 25px;
            box-sizing: border-box;
        }

        .top-ventas-titulo {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 28px;
        }

        .top-ventas-titulo img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .top-ventas-titulo h1 {
            margin: 0;
            font-size: 30px;
            color: #102f24;
        }

        .productos-top {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .producto-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 130px;
            padding: 18px 22px;
            border: 3px solid #709775;
            border-radius: 20px;
            box-sizing: border-box;
        }

        .producto-top-info {
            flex: 1;
            padding-right: 15px;
        }

        .producto-top-info h2 {
            margin: 0 0 5px;
            font-size: 19px;
            color: #102f24;
        }

        .producto-top-info p {
            margin: 0;
            font-size: 16px;
            color: #102f24;
        }

        .producto-top-imagen {
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .producto-top-imagen img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sin-productos {
            text-align: center;
            padding: 20px;
            color: #555;
        }

        @media (max-width: 600px) {

            .inventario,
            .top-ventas {
                width: 92%;
                padding: 20px;
            }

            .producto-inventario {
                grid-template-columns: 75px 1fr auto;
                padding: 10px;
            }

            .producto-imagen {
                width: 65px;
                height: 65px;
            }

            .producto-imagen img {
                width: 65px;
                height: 65px;
            }

            .producto-nombre p,
            .producto-stock p {
                font-size: 14px;
            }

            .producto-top-imagen {
                width: 85px;
                height: 85px;
            }

            .producto-top-info h2 {
                font-size: 16px;
            }

            .producto-top-info p {
                font-size: 14px;
            }

        }

    </style>

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="saludo">

        <h1>
            Hola, <?php echo htmlspecialchars($nombre); ?>
        </h1>

        <p>Bienvenido/a de nuevo!!</p>

    </div>

    <div class="a">

        <a href="Pedidos/leerpedido.php">

            <div class="ab">

                <div class="at">

                    <p>Pedidos Hoy</p>

                    <h1>
                        <?php echo $totalPedidosHoy; ?>
                    </h1>

                </div>

                <img
                    class="imga"
                    src="imagenes/bolsa-de-la-compra.png"
                    alt="Pedidos"
                >

            </div>

        </a>

        <a href="Productos/leerproductos.php">

            <div class="ab">

                <div class="at">

                    <p>Stock</p>

                    <h1>
                        <?php echo $stockTotal; ?>
                    </h1>

                </div>

                <img
                    class="imga"
                    src="imagenes/galleta.png"
                    alt="Stock"
                >

            </div>

        </a>

        <a href="Pedidos/crearpedido.php">

            <div class="ab">

                <div class="at">

                    <p>Ingresar pedidos</p>

                    <h1>+</h1>

                </div>

                <img
                    class="imga"
                    src="imagenes/portapapeles.png"
                    alt="Ingresar"
                >

            </div>

        </a>

        <a href="Ventas/leerventa.php">

            <div class="ab">

                <div class="at">

                    <p>Historial Ventas</p>

                    <h1>+</h1>

                </div>

                <img
                    class="imga"
                    src="imagenes/dinero.png"
                    alt="Ventas"
                >

            </div>

        </a>

        <a href="Usuarios/cerrarsesion.php">

            <div class="ab">

                <div class="at">

                    <h1>Cerrar Sesión</h1>

                </div>

                <img
                    class="imga"
                    src="imagenes/cerrar-sesion.png"
                    alt="Cerrar Sesión"
                >

            </div>

        </a>

    </div>

    <div class="b">

        <div class="ba">

            <div class="bb">

                <h1>Pedidos</h1>

                <img
                    class="bb-img"
                    src="imagenes/bolsa-de-la-compra.png"
                    alt="Ícono Pedidos"
                >

            </div>

            <?php if ($resPedidos && $resPedidos->num_rows > 0) { ?>

                <?php while ($ped = $resPedidos->fetch_assoc()) { ?>

                    <div class="bf">

                        <div class="bg">

                            <div class="bc">

                                <h2>
                                    Pedido #<?php echo sprintf('%03d', $ped['id']); ?>
                                </h2>

                                <p>
                                    <?php echo htmlspecialchars($ped['Nombre']); ?>
                                </p>

                            </div>

                            <div class="bd">

                                <h3>
                                    Bs <?php echo number_format($ped['total_calculado'] ?? 0, 2); ?>
                                </h3>

                                <p>
                                    <?php echo date('d M Y', strtotime($ped['Fecha'])); ?>
                                </p>

                                <p>
                                    <?php echo date('h:i A', strtotime($ped['Fecha'])); ?>
                                </p>

                            </div>

                        </div>

                        <div class="be">

                            <p>

                                <strong>Productos:</strong>

                                <br>

                                <?php
                                echo !empty($ped['resumen_productos'])
                                    ? $ped['resumen_productos']
                                    : "Sin productos asociados";
                                ?>

                            </p>

                        </div>

                        <a
                            href="Ventas/regisventa.php?pedido_id=<?php echo $ped['id']; ?>"
                            class="btn-atender"
                        >
                            Atender Pedido
                        </a>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div
                    class="bf"
                    style="text-align: center; padding: 20px;"
                >

                    <p>
                        No hay pedidos pendientes en este momento.
                    </p>

                </div>

            <?php } ?>

            <a href="Pedidos/leerpedido.php">

                <div class="b-boton">

                    <h1>
                        Ver Todos Los pedidos
                    </h1>

                </div>

            </a>

        </div>

    </div>

    

</body>

</html>