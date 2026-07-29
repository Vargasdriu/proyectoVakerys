<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id_pedido = $_GET['idPedido'];

// 1. Cambiar estado del pedido a 'Finalizado' (Registrar la Venta)
$sqlVenta = "UPDATE pedidos SET Estado = 'Finalizado' WHERE id = '$id_pedido'";

if ($conn->query($sqlVenta)) {

    // 2. Obtener los productos y cantidades compradas en este pedido
    $sqlCarrito = "SELECT productos_Codigo, Cantidad FROM carrito WHERE pedidos_id = '$id_pedido'";
    $resultadoCarrito = $conn->query($sqlCarrito);

    // 3. Descontar la cantidad vendida del Stock en la tabla 'productos'
    if ($resultadoCarrito->num_rows > 0) {
        while ($row = $resultadoCarrito->fetch_assoc()) {
            $codigoProd = $row['productos_Codigo'];
            $cantVendida = $row['Cantidad'];

            $sqlStock = "UPDATE productos SET Stock = Stock - $cantVendida WHERE Codigo = '$codigoProd'";
            $conn->query($sqlStock);
        }
    }

    echo "Venta registrada y stock actualizado con exito.";
    echo "<br><a href='historialVentas.php'>Ver Historial</a>";
} else {
    echo "Error al registrar venta: " . $conn->error;
}

$conn->close();
?>