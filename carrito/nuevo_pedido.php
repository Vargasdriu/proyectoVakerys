<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";


$conn = new mysqli($servidor, $usuario, $contrasena, $bd);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$Nombre = $_POST["Nombre"];
$Fecha = $_POST["Fecha"];
$Estado = $_POST["Estado"];
$NombreVendedor = $_POST["NombreVendedor"];


$sql = "INSERT INTO pedidos (Nombre, Fecha, Estado, NombreVendedor) VALUES ('$Nombre', '$Fecha', '$Estado', '$NombreVendedor')";

if ($conn->query($sql)) {
    
    header("Location: miCarrito.php?idPedido=" . $conn->insert_id);
    exit();
} else {
    echo "Error al registrar el pedido: " . $conn->error;
}


$conn->close();
?>