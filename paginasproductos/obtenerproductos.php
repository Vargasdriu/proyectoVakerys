<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT 
            productos.Codigo,
            productos.NombreProducto,
            productos.PrecioProducto,
            productos.DetalleProducto,
            productos.Stock,
            productos.CostoProducto,
            imagenes.Imagen
        FROM productos
        LEFT JOIN imagenes 
        ON productos.Codigo = imagenes.CodigoProducto
        GROUP BY productos.Codigo";

$resultado = $conn->query($sql);

$productos = array();

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

echo json_encode($productos);

$conn->close();

?>