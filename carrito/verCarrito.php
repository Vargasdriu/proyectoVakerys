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


if (!isset($_GET['idPedido']) || empty($_GET['idPedido'])) {
    die("Error: No se ha especificado un ID de pedido para revisar.");
}

$id_pedido = $_GET['idPedido'];


$sql = "SELECT c.Cantidad, c.CostoTotal, p.NombreProducto, p.PrecioProducto, p.DetalleProducto 
        FROM carrito c
        INNER JOIN productos p ON c.productos_Codigo = p.Codigo
        WHERE c.pedidos_id = '$id_pedido'";

$resultado = $conn->query($sql);


$sqlTotal = "SELECT SUM(CostoTotal) AS total_general FROM carrito WHERE pedidos_id = '$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$filaTotal = $resultadoTotal->fetch_assoc();
$granTotal = $filaTotal['total_general'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen del Pedido #<?php echo $id_pedido; ?></title>

</head>
<body>

    <?php include '../header.php'; ?>

    <div class="box">
        <h2>Resumen de Productos Agregados - Pedido N° <?php echo htmlspecialchars($id_pedido); ?></h2>
        
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad Pedida</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while($item = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($item['NombreProducto']); ?></strong></td>
                            <td><?php echo htmlspecialchars($item['DetalleProducto']); ?></td>
                            <td>Bs. <?php echo htmlspecialchars($item['PrecioProducto']); ?></td>
                            <td><?php echo htmlspecialchars($item['Cantidad']); ?> unidades</td>
                            <td>Bs. <?php echo htmlspecialchars($item['CostoTotal']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #666;">Aún no has agregado ningún producto a este pedido.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="total-box">
            Total del Pedido Actual: Bs. <?php echo number_format($granTotal, 2); ?>
        </div>

        <div class="botones">
            <a href="miCarrito.php?idPedido=<?php echo $id_pedido; ?>" class="btn btn-regresar">← Seguir Agregando Productos</a>
            <a href="../paginavendedor.php" class="btn btn-finalizar">Finalizar y Guardar Pedido ✓</a>
        </div>
    </div>

    <?php include '../footer.php'; ?>

</body>
</html>
<?php $conn->close(); ?>
