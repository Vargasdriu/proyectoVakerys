<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakeryss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$productos_Codigo = $_POST["productos_Codigo"];
$pedidos_id = $_POST["pedidos_id"];
$Cantidad = $_POST["Cantidad"];
$PrecioProducto = $_POST["PrecioProducto"];
$CostoTotal=$PrecioProducto*$Cantidad;

$sql = "INSERT INTO carrito
(productos_Codigo,pedidos_id,Cantidad,CostoTotal)
VALUES
('$productos_Codigo','$pedidos_id','$Cantidad','$CostoTotal')";

if($conn->query($sql)){
    echo "Producto agregado al carrito";
    header("location: miCarrito.php?idPedido=".$idpedido);
}else{
    echo "El producto ya se agregó";
    echo "<a href='fmiCarrito.php?idPedido=$idpedido'>
        <button>Volver a Pedidos</button>
      </a>";
}



?>