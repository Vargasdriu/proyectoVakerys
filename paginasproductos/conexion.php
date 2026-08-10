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

?>