<?php
session_start();
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);
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
        header("Location: ../paginavendedor.php");
       exit();
        

    } elseif ($accion == 'rechazar') {

    // Devolver el stock de los productos del pedido
    $carrito = $conn->query("SELECT productos_Codigo, Cantidad 
                             FROM carrito 
                             WHERE pedidos_id = '$id_pedido'");

    if ($carrito) {
        while ($item = $carrito->fetch_assoc()) {

            $codigo = $item['productos_Codigo'];
            $cant = (int)$item['Cantidad'];

            // Devolver la cantidad al stock
            $conn->query("UPDATE productos 
                          SET Stock = Stock + $cant 
                          WHERE Codigo = '$codigo'");
        }
    }

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </style>
</head>
<body>

<?php include_once "../header.php"; ?>


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

            <form method="post" class="acciones-form" id="formPedido">
                <input type="hidden" name="costoTotal" value="<?php echo $total; ?>">
                <button type="submit" name="accion" value="rechazar" class="btn-accion btn-rechazar">RECHAZAR</button>
                <button type="submit" name="accion" value="aceptar" class="btn-accion btn-aceptar">ACEPTAR</button>
            </form>
        </div>

    </div>
</div>

<?php include_once "../footer.php"; ?>
<script>
const formPedido = document.getElementById('formPedido');

formPedido.addEventListener('submit', function(event) {
    event.preventDefault();

    const accion = event.submitter.value;

    if (accion === 'aceptar') {

        Swal.fire({
            title: 'ACEPTAR PEDIDO',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#A3B18A',
            cancelButtonColor: '#d9534f'
        }).then((result) => {

            if (result.isConfirmed) {
                // Agregamos la acción al formulario
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'accion';
                input.value = 'aceptar';
                formPedido.appendChild(input);

                // Ahora sí enviamos el formulario
                formPedido.submit();
            }

        });

    } else if (accion === 'rechazar') {

        Swal.fire({
            title: 'RECHAZAR PEDIDO',
            showCancelButton: true,
            confirmButtonText: 'Rechazar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#A3B18A',
            cancelButtonColor: '#d9534f'
        }).then((result) => {

            if (result.isConfirmed) {
                // Agregamos la acción al formulario
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'accion';
                input.value = 'rechazar';
                formPedido.appendChild(input);

                // Ahora sí enviamos el formulario
                formPedido.submit();
            }

        });
    }
});
</script>

</body>
</html>