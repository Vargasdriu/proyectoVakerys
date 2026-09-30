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
        ORDER BY productos.Codigo";

$resultado = $conn->query($sql);

$productos = array();

while ($fila = $resultado->fetch_assoc()) {

    $codigo = $fila["Codigo"];

    if (!isset($productos[$codigo])) {

        $productos[$codigo] = array(
            "Codigo" => $fila["Codigo"],
            "NombreProducto" => $fila["NombreProducto"],
            "PrecioProducto" => $fila["PrecioProducto"],
            "DetalleProducto" => $fila["DetalleProducto"],
            "Stock" => $fila["Stock"],
            "CostoProducto" => $fila["CostoProducto"],
            "Imagen" => "",
            "Imagenes" => array()
        );
    }

    if (!empty($fila["Imagen"])) {

        $productos[$codigo]["Imagenes"][] = $fila["Imagen"];

        if (empty($productos[$codigo]["Imagen"])) {
            $productos[$codigo]["Imagen"] = $fila["Imagen"];
        }
    }
}

$productos = array_values($productos);

echo json_encode($productos, JSON_UNESCAPED_UNICODE);

$conn->close();

?>