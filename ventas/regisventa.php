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

// Verificar que se haya enviado un ID de pedido por URL (ejemplo: registrar_venta.php?idPedido=1)
if (!isset($_GET['idPedido'])) {
    die("No se especificó ningún número de pedido.");
}

$id_pedido = $_GET['idPedido'];

// ==========================================
// PROCESAR EL FORMULARIO CUANDO SE ENVÍA (POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estado_seleccionado = $_POST['estado'];
    $metodo_pago = $_POST['metodo_pago'];

    // 1. Actualizar el estado en la tabla 'pedidos'
    $sqlActualizarPedido = "UPDATE pedidos SET Estado = '$estado_seleccionado' WHERE id = '$id_pedido'";
    
    if ($conn->query($sqlActualizarPedido)) {

        // 2. Si el estado es 'Terminado', descontar el Stock de los productos en el inventario
        if ($estado_seleccionado == 'Terminado') {
            $sqlCarrito = "SELECT productos_Codigo, Cantidad FROM carrito WHERE pedidos_id = '$id_pedido'";
            $resultadoCarrito = $conn->query($sqlCarrito);

            if ($resultadoCarrito && $resultadoCarrito->num_rows > 0) {
                while ($item = $resultadoCarrito->fetch_assoc()) {
                    $codigoProd = $item['productos_Codigo'];
                    $cantVendida = $item['Cantidad'];

                    // Descontar la cantidad vendida del stock actual
                    $sqlStock = "UPDATE productos SET Stock = Stock - $cantVendida WHERE Codigo = '$codigoProd'";
                    $conn->query($sqlStock);
                }
            }
        }

        echo "<p>Venta/Pedido registrado exitosamente con estado: <strong>$estado_seleccionado</strong> y método de pago: <strong>$metodo_pago</strong>.</p>";
        echo "<a href='historial_ventas.php'>Ir al Historial de Ventas</a>";
        exit();
    } else {
        echo "Error al registrar la venta: " . $conn->error;
    }
}

// ==========================================
// CONSULTAR DATOS DEL PEDIDO Y DEL CARRITO
// ==========================================

// Consulta de los datos generales del pedido
$sqlPedido = "SELECT * FROM pedidos WHERE id = '$id_pedido'";
$resPedido = $conn->query($sqlPedido);

if ($resPedido->num_rows == 0) {
    die("El pedido #$id_pedido no existe.");
}

$pedido = $resPedido->fetch_assoc();

// Consulta de los productos incluidos en el carrito y cálculo del total
$sqlDetalle = "SELECT c.productos_Codigo, p.NombreProducto, p.PrecioProducto, c.Cantidad, c.CostoTotal 
               FROM carrito c 
               INNER JOIN productos p ON c.productos_Codigo = p.Codigo 
               WHERE c.pedidos_id = '$id_pedido'";
$resDetalle = $conn->query($sqlDetalle);

$costo_total_acumulado = 0;
?>

<h2>Registrar Venta / Cierre de Pedido #<?php echo $pedido['id']; ?></h2>

<form action="registrar_venta.php?idPedido=<?php echo $id_pedido; ?>" method="POST">

    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Método de Pago</th>
        </tr>
        <tr>
            <td>#<?php echo $pedido['id']; ?></td>
            <td><?php echo $pedido['Nombre']; ?></td>
            <td><?php echo $pedido['NombreVendedor']; ?></td>
            <td><?php echo $pedido['Fecha']; ?></td>
            <td>
                <select name="estado" required>
                    <option value="En proceso" <?php if($pedido['Estado'] == 'En proceso') echo 'selected'; ?>>En proceso</option>
                    <option value="Terminado" <?php if($pedido['Estado'] == 'Terminado' || $pedido['Estado'] == 'Finalizado') echo 'selected'; ?>>Terminado</option>
                </select>
            </td>
            <td>
                <select name="metodo_pago" required>
                    <option value="Efectivo">Efectivo</option>
                    <option value="QR">QR</option>
                </select>
            </td>
        </tr>
    </table>

    <br><br>

    <h3>Detalle de Productos en el Pedido</h3>

    <table border="1">
        <tr>
            <th>Código</th>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>

        <?php
        if ($resDetalle && $resDetalle->num_rows > 0) {
            while ($row = $resDetalle->fetch_assoc()) {
                $costo_total_acumulado += $row['CostoTotal'];
                echo "<tr>";
                echo "<td>" . $row['productos_Codigo'] . "</td>";
                echo "<td>" . $row['NombreProducto'] . "</td>";
                echo "<td>Bs. " . $row['PrecioProducto'] . "</td>";
                echo "<td>" . $row['Cantidad'] . "</td>";
                echo "<td>Bs. " . $row['CostoTotal'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay productos agregados a este pedido.</td></tr>";
        }
        ?>

        <tr>
            <td colspan="4" align="right"><strong>Costo Total:</strong></td>
            <td><strong>Bs. <?php echo $costo_total_acumulado; ?></strong></td>
        </tr>
    </table>

    <br><br>

    <button type="submit">Confirmar y Registrar Venta</button>

</form>

<?php $conn->close(); ?>