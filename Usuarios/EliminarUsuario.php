<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username,$password,$bdname);

if($conexion -> connect_error){
    echo "Hubo un error";
}
$CI = $_GET['CI'];
$sql = "DELETE FROM GestionDeUsuarios WHERE  CI = '$CI'";
if ($conexion->query($sql) === TRUE) {
    echo "Usuario eliminado correctamente.";
}
 else {
    echo "Error: " . $conexion->error;
}
?>