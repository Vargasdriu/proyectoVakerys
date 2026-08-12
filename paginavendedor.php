<?php
session_start();
$nombre = isset($_SESSION['Nombre']) ? $_SESSION['Nombre'] : "Vendedor";

$conn = new mysqli("localhost", "root", "", "vakerysss");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 1. Contar pedidos pendientes (excluyendo Aceptado y Cancelado)
$resTotalPedidos = $conn->query("SELECT COUNT(*) AS total FROM pedidos WHERE Estado IS NULL OR Estado NOT IN ('Aceptado', 'Cancelado')");
$totalPedidosHoy = ($resTotalPedidos) ? $resTotalPedidos->fetch_assoc()['total'] : 0;

// 2. Sumar el Stock total disponible en productos
$resStockTotal = $conn->query("SELECT SUM(Stock) AS total_stock FROM productos");
$stockTotal = ($resStockTotal) ? $resStockTotal->fetch_assoc()['total_stock'] : 0;

// 3. Consultar pedidos pendientes o activos
$sqlPedidos = "SELECT p.*, 
               GROUP_CONCAT(CONCAT(pr.NombreProducto, ' x', c.Cantidad) SEPARATOR '<br>') AS resumen_productos,
               SUM(c.CostoTotal) AS total_calculado
               FROM pedidos p
               LEFT JOIN carrito c ON p.id = c.pedidos_id
               LEFT JOIN productos pr ON c.productos_Codigo = pr.Codigo
               WHERE p.Estado IS NULL OR p.Estado NOT IN ('Aceptado', 'Cancelado')
               GROUP BY p.id
               ORDER BY p.id DESC";

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

        /* Estilo para el botón Atender Pedido */
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
           transform:scale(1.03);
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="saludo">
        <h1>¡Hola, <?php echo htmlspecialchars($nombre); ?>!</h1>
        <p>Bienvenido/a de nuevo.</p>
    </div>

    <div class="a">
        <a href="Pedidos/leerpedido.php">    
            <div class="ab">
                <div class="at">
                    <p>Pedidos Hoy</p>
                    <h1><?php echo $totalPedidosHoy; ?></h1>
                </div>
                <img class="imga" src="imagenes/bolsa-de-la-compra.png" alt="Pedidos">
            </div>
        </a>

        <a href="Productos/leerproductos.php">
            <div class="ab">
                <div class="at">
                    <p>Stock</p>
                    <h1><?php echo $stockTotal ? $stockTotal : 0; ?></h1>
                </div>
                <img class="imga" src="imagenes/galleta.png" alt="Stock">
            </div>
        </a>

        <a href="Pedidos/crearpedido.php">
            <div class="ab">
                <div class="at">
                    <p>Ingresar pedidos</p>
                    <h1>+</h1>
                </div>
                <img class="imga" src="imagenes/portapapeles.png" alt="Ingresar">
            </div>
        </a>

        <a href="Usuarios/cerrarsesion.php">
            <div class="ab">
                <div class="at">
                    <h1>Cerrar Sesión</h1>
                </div>
                <img class="imga" src="imagenes/cerrar-sesion.png" alt="Cerrar Sesión">
            </div>
        </a>
    </div>

    <div class="b">
        <div class="ba">
            <div class="bb">
                <h1>Pedidos</h1>
                <img class="bb-img" src="imagenes/bolsa-de-la-compra.png" alt="Ícono Pedidos">
            </div>

            <?php if ($resPedidos && $resPedidos->num_rows > 0) { ?>
                <?php while ($ped = $resPedidos->fetch_assoc()) { ?>
                    <div class="bf">
                        <div class="bg">
                            <div class="bc">
                                <h2>Pedido #<?php echo sprintf('%03d', $ped['id']); ?></h2>
                                <p><?php echo htmlspecialchars($ped['Nombre']); ?></p>
                            </div>
                            <div class="bd">
                                <h3>Bs <?php echo number_format($ped['total_calculado'] ? $ped['total_calculado'] : 0, 2); ?></h3>
                                <p><?php echo date('d M Y', strtotime($ped['Fecha'])); ?></p>
                                <p><?php echo date('h:i A', strtotime($ped['Fecha'])); ?></p>
                            </div>
                        </div>
                        <div class="be">
                            <p><strong>Productos:</strong><br>
                            <?php echo $ped['resumen_productos'] ? $ped['resumen_productos'] : "Sin productos asociados"; ?>
                            </p>
                        </div>

                        <a href="Ventas/regisventa.php?pedido_id=<?php echo $ped['id']; ?>" class="btn-atender">
                            Atender Pedido
                        </a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="bf" style="text-align: center; padding: 20px;">
                    <p>No hay pedidos pendientes en este momento.</p>
                </div>
            <?php } ?>

            <a href="Pedidos/leerpedido.php">
                <div class="b-boton">
                    <h1>Ver Todos Los pedidos</h1>
                </div>
            </a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>