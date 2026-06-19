<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss"; 

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

session_start();

if (!isset($_GET['idPedido']) || empty($_GET['idPedido'])) {
    header("Location: formPedido.php");
    exit();
}

$id_pedido = $_GET['idPedido'];

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

$sqlTotal = "SELECT SUM(CostoTotal) AS total_pedido FROM carrito WHERE pedidos_id = '$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['total_pedido'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - Vakery's</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway:wght@400;500;700&display=swap" rel="stylesheet">
    
</head>
<body>

    <?php include '../header.php'; ?>

    <div class="carrito-section">
        <div class="carrito-header">
            <h1>Total del Pedido<?php echo "($total)";?></h1>
            <div class="total-badge">Total: Bs. <?php echo number_format($total, 2); ?></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre del Producto</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Agregar al Carrito</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <form action="agregarCarrito.php" method="POST">
                        <tr>
                            <td><?php echo htmlspecialchars($fila["Codigo"]); ?></td>
                            <td><strong><?php echo htmlspecialchars($fila["NombreProducto"]); ?></strong></td>
                            <td><?php echo htmlspecialchars($fila["DetalleProducto"]); ?></td>
                            <td>Bs. <?php echo htmlspecialchars($fila["PrecioProducto"]); ?></td>
                            
                            <input type="hidden" value="<?php echo $fila["Codigo"]; ?>" name="codigo">
                            <input type="hidden" value="<?php echo $id_pedido; ?>" name="idpedido">
                            <input type="hidden" value="<?php echo $fila["PrecioProducto"]; ?>" name="precio">
                            
                            <td>
                                <input type="number" name="cantidad" value="1" min="1" max="<?php echo $fila['Stock']; ?>">
                            </td>
                            <td>
                                <button type="submit" class="btn-add">Agregar</button>
                            </td>
                        </tr>
                    </form>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="container-buttons">
            <a href="formPedido.php" class="btn-nav-back">Nuevo Pedido</a>