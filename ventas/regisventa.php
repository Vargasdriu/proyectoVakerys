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
$mostrar_modal = false;
$titulo_modal = "";
$mensaje_modal = "";

// ==========================================
// PROCESAR BOTONES (ACEPTAR / RECHAZAR)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];

    if ($accion == 'aceptar') {

        // 1. Cambiar estado del pedido a 'Aceptado'
        $conn->query("UPDATE pedidos SET Estado = 'Aceptado' WHERE id = '$id_pedido'");

        // 2. Descontar Stock de forma segura
        $productosAgotados = [];
        $carrito = $conn->query("SELECT c.productos_Codigo, c.Cantidad, p.NombreProducto 
                                  FROM carrito c 
                                  INNER JOIN productos p ON c.productos_Codigo = p.Codigo 
                                  WHERE c.pedidos_id = '$id_pedido'");

        if ($carrito) {
            while ($item = $carrito->fetch_assoc()) {
                $codigo = $item['productos_Codigo'];
                $cant = (int)$item['Cantidad'];
                $nombreProd = $item['NombreProducto'];

                // Evita que el stock baje de 0
                $conn->query("UPDATE productos SET Stock = GREATEST(0, Stock - $cant) WHERE Codigo = '$codigo'");

                // Consultar el stock actualizado
                $resNuevoStock = $conn->query("SELECT Stock FROM productos WHERE Codigo = '$codigo'");
                if ($resNuevoStock) {
                    $nuevoStock = (int)$resNuevoStock->fetch_assoc()['Stock'];
                    if ($nuevoStock === 0) {
                        $productosAgotados[] = $nombreProd;
                    }
                }
            }
        }

        // 3. Registrar la Venta
        $costoTotal = $_POST['costoTotal'];
        $conn->query("INSERT INTO ventas (pedidos_id, costoTotal, Estado, Metodo) VALUES ('$id_pedido', '$costoTotal', 'Aceptado', 'Efectivo')");

        // 4. Activar Modal flotante estilizada
        $mostrar_modal = true;
        $titulo_modal = "¡Pedido Guardado Exitosamente!";

        if (!empty($productosAgotados)) {
            $listaAgotados = implode(", ", $productosAgotados);
            $mensaje_modal = "El pedido #".sprintf('%03d', $id_pedido)." fue procesado con éxito.<br><br><span style='color:#d9534f; font-weight:bold;'>Atención:</span> Se vendió el/los último(s) producto(s) en stock de: <strong>$listaAgotados</strong>. Su stock actual es 0.";
        } else {
            $mensaje_modal = "El pedido #".sprintf('%03d', $id_pedido)." ha sido aceptado y registrado en el sistema correctamente.";
        }

    } elseif ($accion == 'rechazar') {
        // Cambiar estado a Cancelado
        $conn->query("UPDATE pedidos SET Estado = 'Cancelado' WHERE id = '$id_pedido'");
        header("Location: ../paginavendedor.php");
        exit();
    }
}

// ==========================================
// CONSULTAR DATOS DEL PEDIDO Y PRODUCTOS
// ==========================================
$resPedido = $conn->query("SELECT * FROM pedidos WHERE id = '$id_pedido'");
$pedido = $resPedido ? $resPedido->fetch_assoc() : null;

if (!$pedido) {
    die("El pedido #$id_pedido no existe.");
}

$sqlCarrito = "SELECT c.Cantidad, c.CostoTotal, p.NombreProducto, p.PrecioProducto, p.Stock 
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
    <link rel="stylesheet" href="../estilos/vendedor.css">
    <style>
        a {
            text-decoration: none;
            color: inherit;
        }

        .btn-volver-link {
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
            color: #1f2d25;
            font-size: 14px;
        }

        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .tabla-productos th {
            background-color: #afc194;
            color: #1f2d25;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .tabla-productos td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #333;
        }

        .total-row td {
            font-weight: bold;
            font-size: 15px;
            background-color: #f9fbf8;
            color: #1f2d25;
        }

        .acciones-form {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn-accion {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-aceptar {
            background: #A3B18A;
    color: #1f2d25;
        }

        .btn-aceptar:hover {
            
    transform:scale(1.03);
        }

        .btn-rechazar {
            background: #d9534f;
            color: #ffffff;
        }

        .btn-rechazar:hover {
            background: #c9302c;
        }

        .estado-tag-badge {
            background: #afc194;
            color: #1f2d25;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }

        .stock-alerta {
            color: #d9534f;
            font-weight: bold;
        }
        
        .stock-normal {
            color: #2e7d32;
            font-weight: bold;
        }

        /* --- ESTILOS DEL ALERT/MODAL DE ÉXITO --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-contenedor {
            background-color: #ffffff;
            border-radius: 12px;
            width: 90%;
            max-width: 420px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border-top: 6px solid #afc194;
            animation: aparecer 0.3s ease-out;
        }

        @keyframes aparecer {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-icono {
            width: 60px;
            height: 60px;
            background-color: #afc194;
            color: #1f2d25;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            margin: 0 auto 15px auto;
        }

        .modal-titulo {
            font-size: 18px;
            color: #1f2d25;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .modal-mensaje {
            font-size: 14px;
            color: #709775;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .modal-btn {
            display: block;
            width: 100%;
            background-color: #1f2d25;
            color: #ffffff;
            padding: 12px 0;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .modal-btn:hover {
            background-color: #afc194;
            color: #1f2d25;
        }
    </style>
</head>
<body>

<?php include_once "../header.php"; ?>

<?php if ($mostrar_modal): ?>
<div class="modal-overlay">
    <div class="modal-contenedor">
        <div class="modal-icono">&#10003;</div>
        <h2 class="modal-titulo"><?php echo $titulo_modal; ?></h2>
        <p class="modal-mensaje"><?php echo $mensaje_modal; ?></p>
        <a href="../paginavendedor.php" class="modal-btn">Continuar</a>
    </div>
</div>
<?php endif; ?>

<div class="b" style="margin-top: 20px;">
    <div class="ba">

        <div class="bb">
            <h1>Atender Pedido #<?php echo sprintf('%03d', $pedido['id']); ?></h1>
            <span class="estado-tag-badge"><?php echo $pedido['Estado'] ? $pedido['Estado'] : 'Pendiente'; ?></span>
        </div>

        <a href="../paginavendedor.php" class="btn-volver-link">&larr; Volver a lista de pedidos</a>

        <div class="bf" style="margin-bottom: 20px;">
            <div class="bg">
                <div class="bc">
                    <h2>Cliente: <?php echo htmlspecialchars($pedido['Nombre']); ?></h2>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($pedido['Telefono']); ?></p>
                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($pedido['Direccion']); ?></p>
                </div>
                <div class="bd">
                    <p><strong>Fecha:</strong> <?php echo date('d M Y', strtotime($pedido['Fecha'])); ?></p>
                    <p><strong>Hora:</strong> <?php echo date('h:i A', strtotime($pedido['Fecha'])); ?></p>
                </div>
            </div>
        </div>

        <div class="be">
            <h3 style="color:#1f2d25; margin-bottom: 10px; font-size: 16px;">Productos Solicitados</h3>

            <table class="tabla-productos">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Stock Actualizado</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad Solicitada</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($resCarrito && $resCarrito->num_rows > 0) {
                        while ($prod = $resCarrito->fetch_assoc()) { 
                            $total += $prod['CostoTotal']; 
                            $esUltimoStock = ($prod['Stock'] <= $prod['Cantidad']);
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($prod['NombreProducto']); ?></td>
                            <td class="<?php echo $esUltimoStock ? 'stock-alerta' : 'stock-normal'; ?>">
                                <?php echo $prod['Stock']; ?> unids. 
                                <?php if ($esUltimoStock) echo "<br><small style='color:#d9534f;'>(Último(s) producto(s) en stock)</small>"; ?>
                            </td>
                            <td>Bs. <?php echo number_format($prod['PrecioProducto'], 2); ?></td>
                            <td><?php echo $prod['Cantidad']; ?></td>
                            <td>Bs. <?php echo number_format($prod['CostoTotal'], 2); ?></td>
                        </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No hay productos asociados a este pedido.</td></tr>";
                    }
                    ?>
                    <tr class="total-row">
                        <td colspan="4" style="text-align: right;">Total General:</td>
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
</div>

<?php include_once "../footer.php"; ?>

</body>
</html>