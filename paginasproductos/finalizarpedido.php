<?php

session_start();

require("conexion.php");

header("Content-Type: application/json; charset=utf-8");

if (!isset($_SESSION["pedido"])) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "No existe pedido"
    ]);

    exit;
}

$idPedido = $_SESSION["pedido"];

try {

    // ==========================================
    // 1. OBTENER PRODUCTOS DEL PEDIDO
    // ==========================================

    $sqlCarrito = "
        SELECT
            productos_Codigo,
            Cantidad
        FROM carrito
        WHERE pedidos_id = '$idPedido'
    ";

    $resultado = $conn->query($sqlCarrito);

    if (!$resultado) {
        throw new Exception($conn->error);
    }

    // ==========================================
    // VERIFICAR QUE HAYA PRODUCTOS
    // ==========================================

    if ($resultado->num_rows == 0) {

        throw new Exception(
            "El pedido no tiene productos asociados."
        );
    }

    // ==========================================
    // 2. RESTAR STOCK
    // ==========================================

    while ($producto = $resultado->fetch_assoc()) {

        $codigo = $producto["productos_Codigo"];
        $cantidad = (int)$producto["Cantidad"];

        $sqlStock = "
            UPDATE productos
            SET Stock = Stock - $cantidad
            WHERE Codigo = '$codigo'
            AND Stock >= $cantidad
        ";

        if (!$conn->query($sqlStock)) {
            throw new Exception($conn->error);
        }

        if ($conn->affected_rows == 0) {

            throw new Exception(
                "No hay suficiente stock para el producto: " . $codigo
            );
        }
    }

    // ==========================================
    // 3. FINALIZAR PEDIDO
    // ==========================================

    $sqlPedido = "
        UPDATE pedidos
        SET Estado = 'Activo'
        WHERE id = '$idPedido'
    ";

    if (!$conn->query($sqlPedido)) {
        throw new Exception($conn->error);
    }



    echo json_encode([
        "ok" => true,
        "pedido" => $idPedido,
        "mensaje" => "Pedido finalizado correctamente"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "ok" => false,
        "mensaje" => $e->getMessage()
    ]);
}

?>