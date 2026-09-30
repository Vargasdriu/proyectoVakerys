<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$idImagen = $_GET["id"] ?? '';
$codigo = $_GET["codigo"] ?? '';

$stmt = $conn->prepare(
    "SELECT Imagen FROM imagenes WHERE idImagen = ?"
);

$stmt->bind_param("i", $idImagen);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();
    $ruta = $fila["Imagen"];

   $stmtEliminar = $conn->prepare(
    "DELETE FROM imagenes WHERE idImagen = ?"
);

$stmtEliminar->bind_param("i", $idImagen);

if ($stmtEliminar->execute()) {

        if (file_exists($ruta)) {
            unlink($ruta);
        }

    }

}

$conn->close();

header("Location: verimagenes.php?codigo=".$codigo);
exit;