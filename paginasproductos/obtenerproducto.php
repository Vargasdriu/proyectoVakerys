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


$codigo = $_GET["codigo"];


/* BUSCAR PRODUCTO */

$sql = "SELECT *
        FROM productos
        WHERE Codigo = '$codigo'";

$resultado = $conn->query($sql);


if ($resultado->num_rows == 0) {

    echo json_encode([
        "error" => "Producto no encontrado"
    ]);

    exit;

}


$producto = $resultado->fetch_assoc();


/* BUSCAR IMÁGENES */

$sqlImagenes = "SELECT Imagen
                FROM imagenes
                WHERE CodigoProducto = '$codigo'";

$resultadoImagenes = $conn->query($sqlImagenes);


$imagenes = array();


while ($fila = $resultadoImagenes->fetch_assoc()) {

    $imagenes[] = $fila["Imagen"];

}


$producto["imagenes"] = $imagenes;


/* DEVOLVER JSON */

echo json_encode($producto);


$conn->close();

?>