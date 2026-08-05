<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$idImagen = $_GET["id"];
$codigo = $_GET["codigo"];

$sql = "SELECT Imagen FROM imagenes WHERE idImagen = '$idImagen'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();
    $ruta = $fila["Imagen"];

    $sql = "DELETE FROM imagenes WHERE idImagen = '$idImagen'";

    if ($conn->query($sql)) {

        if (file_exists($ruta)) {
            unlink($ruta);
        }

    }

}

$conn->close();

header("Location: verimagenes.php?codigo=".$codigo);
exit;