<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error) {
    die("Error de conexión");
}
include '../header.php';
include_once "validacion.php";

$stmt = $conexion->prepare(
    "UPDATE GestionDeUsuarios 
     SET Estado = 'activo' 
     WHERE CI = ?"
);

$stmt->bind_param("s", $CI);

$stmt->execute();

$conexion->close();

header("Location: leerusuario.php");
exit();
?>