<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "mitienda";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$estado = $_POST["estado"];
$nombreVendedor = $_POST["nombreVendedor"];

$sql = "INSERT INTO pedido(Nombre, Fecha, Estado, NombreVendedor) VALUES ('$nombre', '$fecha', '$estado', '$nombreVendedor')";

if($conn->query($sql)){
    header("location: miCarrito.php?idPedido=".$conn->insert_id);
}else{
    echo "Error: " . $conn->error;
}

$conn->close();

?>