
<?php

require("conexion.php");

header("Content-Type: application/json");

$id = $_POST["id"] ?? "";


if ($id == "") {

    echo json_encode([
        "ok" => false,
        "mensaje" => "No se recibió el número de pedido"
    ]);

    exit;
}


$sql = "
    SELECT *
    FROM pedidos
    WHERE id = '$id'
";


$resultado = $conn->query($sql);


if ($resultado->num_rows > 0) {

    $pedido = $resultado->fetch_assoc();


    echo json_encode([

        "ok" => true,

        "pedido" => $pedido

    ]);


} else {

    echo json_encode([

        "ok" => false,

        "mensaje" => "Pedido no encontrado"

    ]);

}


$conn->close();

?>

