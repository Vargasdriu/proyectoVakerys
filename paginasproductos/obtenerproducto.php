<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli(
    $servidor,
    $usuario,
    $contrasena,
    $bd
);

if ($conn->connect_error) {

    die("Error de conexión: " . $conn->connect_error);

}

$conn->set_charset("utf8");


$codigo = $_GET["codigo"] ?? '';

$stmt = $conn->prepare(
    "SELECT *
     FROM productos
     WHERE Codigo = ?"
);

$stmt->bind_param("s", $codigo);

$stmt->execute();

$resultado = $stmt->get_result();


if ($resultado->num_rows == 0) {

    echo json_encode([
        "error" => "Producto no encontrado"
    ]);

    exit;

}


$producto = $resultado->fetch_assoc();



$stmtImagenes = $conn->prepare(
    "SELECT Imagen
     FROM imagenes
     WHERE CodigoProducto = ?"
);

$stmtImagenes->bind_param("s", $codigo);

$stmtImagenes->execute();

$resultadoImagenes = $stmtImagenes->get_result();


$imagenes = array();


while ($fila = $resultadoImagenes->fetch_assoc()) {

    $imagenes[] = $fila["Imagen"];

}


$producto["imagenes"] = $imagenes;



echo json_encode($producto);


$conn->close();

?>