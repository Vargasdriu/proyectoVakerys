<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error) {
    die("Error de conexión");
}

include_once "validacion.php";

$sql = "UPDATE GestionDeUsuarios SET Estado='activo' WHERE CI='$CI'";
$conexion->query($sql);

$conexion->close();

header("Location: leerusuario.php");
exit();
?>