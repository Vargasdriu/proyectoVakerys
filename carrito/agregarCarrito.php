<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "mitienda";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$codigo = $_POST["codigo"];
$idpedido = $_POST["idpedido"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$total=$precio*$cantidad;

$sql = "INSERT INTO carrito
(Producto_codigo,Pedido_id,cantidad,costototal)
VALUES
('$codigo','$idpedido','$cantidad','$total')";

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