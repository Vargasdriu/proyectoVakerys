<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username,$password,$bdname);

if($conexion -> connect_error){
    echo "Hubo un error";
}
$CorreoCliente = $_GET['CorreoCliente'];
$sql = "DELETE FROM Clientes WHERE  CorreoCliente = '$CorreoCliente'";
if ($conexion->query($sql) === TRUE) {
    echo "Cliente eliminado correctamente.";
}
 else {
    echo "Error: " . $conexion->error;
}
?>
