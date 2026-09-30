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

$stmtCarrito = $conn->prepare(
    "SELECT
        productos_Codigo,
        Cantidad
     FROM carrito
     WHERE pedidos_id = ?"
);

$stmtCarrito->bind_param("i", $idPedido);

$stmtCarrito->execute();

$resultado = $stmtCarrito->get_result();

    if (!$resultado) {
        throw new Exception($conn->error);
    }

    if ($resultado->num_rows == 0) {

        throw new Exception(
            "El pedido no tiene productos asociados."
        );
    }

$stmtPedido = $conn->prepare(
    "UPDATE pedidos
     SET Estado = 'Activo'
     WHERE id = ?"
);

$stmtPedido->bind_param("i", $idPedido);

if (!$stmtPedido->execute())  {
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
