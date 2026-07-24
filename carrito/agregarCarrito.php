<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$codigo = $_POST["codigo"];
$idpedido = $_POST["idpedido"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$total = $precio * $cantidad;

$sqlStock = "SELECT Stock FROM productos WHERE Codigo='$codigo'";
$resultado = $conn->query($sqlStock);
$fila = $resultado->fetch_assoc();

if($fila["Stock"] < $cantidad){
    echo "No hay suficiente stock";
    exit();
}



$sql = "INSERT INTO carrito (productos_Codigo, pedidos_id, Cantidad, CostoTotal)
        VALUES ('$codigo', '$idpedido', '$cantidad', '$total')
        ON DUPLICATE KEY UPDATE
            Cantidad = Cantidad + VALUES(Cantidad),
            CostoTotal = CostoTotal + VALUES(CostoTotal)";

if($conn->query($sql)){

    $sql2 = "UPDATE productos
             SET Stock = Stock - $cantidad
             WHERE Codigo='$codigo'";

    $conn->query($sql2);
    header("Location: miCarrito.php?idPedido=".$idpedido);
    exit();
}else{
    echo "Error crítico en el proceso del carrito de compras: " . $conn->error;
}


if($conn->query($sql)){
    
    header("Location: miCarrito.php?idPedido=" . $idpedido);
    exit();
} else {
    echo "Error crítico en el proceso del carrito de compras: " . $conn->error;
}

$conn->close();
?>