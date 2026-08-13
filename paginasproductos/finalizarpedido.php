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

$idPedidos = $_SESSION["pedido"];

try {

    // ==========================================
    // 1. OBTENER LOS PRODUCTOS DEL PEDIDO
    // ==========================================

    $sqlCarrito = "
        SELECT productos_Codigo, Cantidad
        FROM carrito
        WHERE pedidos_id = '$idPedidos'
    ";

    $resultado = $conn->query($sqlCarrito);

    if (!$resultado) {
        throw new Exception($conn->error);
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
        SET Estado = 'Finalizado'
        WHERE id = '$idPedidos'
    ";

    if (!$conn->query($sqlPedido)) {
        throw new Exception($conn->error);
    }


    // ==========================================
    // 4. VACIAR CARRITO
    // ==========================================

    $sqlVaciar = "
        DELETE FROM carrito
        WHERE pedidos_id = '$idPedidos'
    ";

    if (!$conn->query($sqlVaciar)) {
        throw new Exception($conn->error);
    }


    // ==========================================
    // 5. RESPUESTA
    // ==========================================

    echo json_encode([
        "ok" => true,
        "pedido" => $idPedidos,
        "mensaje" => "Pedido finalizado correctamente"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "ok" => false,
        "mensaje" => $e->getMessage()
    ]);
}

?>