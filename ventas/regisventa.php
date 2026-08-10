<?php
session_start();

$conn = new mysqli("localhost", "root", "", "vakerysss");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (!isset($_GET['pedido_id']) || empty($_GET['pedido_id'])) {
    header("Location: ../paginavendedor.php");
    exit();
}

$id_pedido = $_GET['pedido_id'];

// ==========================================
// PROCESAR BOTONES (ACEPTAR / RECHAZAR)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];

    if ($accion == 'aceptar') {
        // 1. Cambiar estado a 'Aceptado'
        $conn->query("UPDATE pedidos SET Estado = 'Aceptado' WHERE id = '$id_pedido'");

        // 2. Descontar Stock de los productos
        $carrito = $conn->query("SELECT productos_Codigo, Cantidad FROM carrito WHERE pedidos_id = '$id_pedido'");
        if ($carrito) {
            while ($item = $carrito->fetch_assoc()) {
                $codigo = $item['productos_Codigo'];
                $cant = $item['Cantidad'];
                $conn->query("UPDATE productos SET Stock = Stock - $cant WHERE Codigo = '$codigo'");
            }
        }

        // 3. Registrar la Venta con estado 'Aceptado'
        $costoTotal = $_POST['costoTotal'];
        $conn->query("INSERT INTO ventas (pedidos_id, costoTotal, Estado, Metodo) VALUES ('$id_pedido', '$costoTotal', 'Aceptado', 'Efectivo')");

    } elseif ($accion == 'rechazar') {
        // Cambiar estado a Cancelado
        $conn->query("UPDATE pedidos SET Estado = 'Cancelado' WHERE id = '$id_pedido'");
    }

    header("Location: ../paginavendedor.php");
    exit();
}

// ==========================================
// CONSULTAR DATOS DEL PEDIDO Y PRODUCTOS
// ==========================================
$resPedido = $conn->query("SELECT * FROM pedidos WHERE id = '$id_pedido'");
$pedido = $resPedido ? $resPedido->fetch_assoc() : null;

if (!$pedido) {
    die("El pedido #$id_pedido no existe.");
}

$sqlCarrito = "SELECT c.Cantidad, c.CostoTotal, p.NombreProducto, p.PrecioProducto 
               FROM carrito c 
               INNER JOIN productos p ON c.productos_Codigo = p.Codigo 
               WHERE c.pedidos_id = '$id_pedido'";
$resCarrito = $conn->query($sqlCarrito);
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atender Pedido #<?php echo $id_pedido; ?> - Vakery's</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #1f2d25;
            padding-top: 20px;
        }

        .contenedor-detalle {
            max-width: 850px;
            margin: 30px auto 50px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .header-detalle {
            background: #1f2d25;
            color: #ffffff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-detalle h2 {
            font-size: 20px;
            color: #afc194;
        }

        .estado-tag {
            background: #afc194;
            color: #1f2d25;
            padding: 6px 14px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: bold;
        }

        .body-detalle {
            padding: 30px;
        }

        .btn-volver {
            display: inline-block;
            margin-bottom: 20px;
            color: #1f2d25;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .grid-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
            background: #f4f6f4;
            padding: 18px;
            border-radius: 6px;
        }

        .info-item h4 {
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 4px;
        }

        .info-item p {
            font-size: 15px;
            font-weight: bold;
            color: #1f2d25;
        }

        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .tabla-productos th {
            background: #afc194;
            color: #1f2d25;
            text-align: left;
            padding: 12px;
            font-size: 14px;
        }

        .tabla-productos td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .tabla-productos tr:last-child td {
            border-bottom: none;
        }

        .total-row {
            background: #f9fbf8;
            font-weight: bold;
            font-size: 15px;
        }

        .acciones-form {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn-accion {
            padding: 12px 28px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-aceptar {
            background: #1f2d25;
            color: #ffffff;
        }

        .btn-aceptar:hover {
            background: #afc194;
            color: #1f2d25;
        }

        .btn-rechazar {
            background: #d9534f;
            color: #ffffff;
        }

        .btn-rechazar:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>

<?php include_once "../header.php"; ?>

<div class="contenedor-detalle">
    <div class="header-detalle">
        <h2>Pedido #<?php echo sprintf('%03d', $pedido['id']); ?></h2>
        <span class="estado-tag"><?php echo $pedido['Estado'] ? $pedido['Estado'] : 'Pendiente'; ?></span>
    </div>

    <div class="body-detalle">
        <a href="../paginavendedor.php" class="btn-volver">&larr; Volver a lista de pedidos</a>

        <div class="grid-info">
            <div class="info-item">
                <h4>Cliente</h4>
                <p><?php echo htmlspecialchars($pedido['Nombre']); ?></p>
            </div>
            <div class="info-item">
                <h4>Fecha</h4>
                <p><?php echo $pedido['Fecha']; ?></p>
            </div>
            <div class="info-item">
                <h4>Teléfono</h4>
                <p><?php echo htmlspecialchars($pedido['Telefono']); ?></p>
            </div>
            <div class="info-item">
                <h4>Dirección</h4>
                <p><?php echo htmlspecialchars($pedido['Direccion']); ?></p>
            </div>
        </div>

        <h3 style="color:#1f2d25; margin-bottom: 10px; font-size: 18px;">Productos Solicitados</h3>

        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($resCarrito && $resCarrito->num_rows > 0) {
                    while ($prod = $resCarrito->fetch_assoc()) { 
                        $total += $prod['CostoTotal']; 
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($prod['NombreProducto']); ?></td>
                        <td>Bs. <?php echo number_format($prod['PrecioProducto'], 2); ?></td>
                        <td><?php echo $prod['Cantidad']; ?></td>
                        <td>Bs. <?php echo number_format($prod['CostoTotal'], 2); ?></td>
                    </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='4' style='text-align:center;'>No hay productos asociados a este pedido.</td></tr>";
                }
                ?>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Total General:</td>
                    <td>Bs. <?php echo number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>

        <form method="post" class="acciones-form">
            <input type="hidden" name="costoTotal" value="<?php echo $total; ?>">
            <button type="submit" name="accion" value="rechazar" class="btn-accion btn-rechazar">RECHAZAR</button>
            <button type="submit" name="accion" value="aceptar" class="btn-accion btn-aceptar">ACEPTAR</button>
        </form>
    </div>
</div>

<?php include_once "../footer.php"; ?>

</body>
</html>