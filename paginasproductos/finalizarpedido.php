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

    if ($resultado->num_rows == 0) {

        throw new Exception(
            "El pedido no tiene productos asociados."
        );
    }

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
