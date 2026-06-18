<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss"; // Cambiado a tu BD actual

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$Nombre = $_POST["Nombre"];
$Fecha = $_POST["Fecha"];
$Estado = $_POST["Estado"];
$NombreVendedor = $_POST["NombreVendedor"];

// Ajustado al nombre de la tabla 'pedidos'
$sql = "INSERT INTO pedidos(Nombre, Fecha, Estado, NombreVendedor) VALUES ('$Nombre', '$Fecha', '$Estado', '$NombreVendedor')";

if($conn->query($sql)){
    // Redirige pasando el ID correcto generado
    header("location: miCarrito.php?idPedido=".$conn->insert_id);
    exit();
}else{
    echo "Error: " . $conn->error;
}

$conn->close();
?>