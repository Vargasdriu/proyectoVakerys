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

$sql = "
    UPDATE Pedido
    SET EstadoPedido = 'Finalizado'
    WHERE id = '$idPedido'
";

if ($conn->query($sql)) {

    echo json_encode([
        "ok" => true,
        "pedido" => $idPedido
    ]);

} else {

    echo json_encode([
        "ok" => false,
        "mensaje" => $conn->error
    ]);
}

?>