<?php

$servidor = getenv('DB_HOST');
$usuario = getenv('DB_USER');
$contrasena = getenv('DB_PASS');
$bd = getenv('DB_NAME');

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