<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username,$password,$bdname);

if($conexion -> connect_error){
    echo "Hubo un error";
}
$Codigo = $_GET['Codigo'];
$sql = "DELETE FROM Productos WHERE Codigo = '$Codigo'";
if ($conexion->query($sql) === TRUE) {
    echo "Producto eliminado correctamente.";
}
 else {
    echo "Error: " . $conexion->error;
}
?>
