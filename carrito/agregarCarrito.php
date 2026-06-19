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

$sql = "INSERT INTO carrito(productos_Codigo, pedidos_id, Cantidad, CostoTotal) VALUES ('$codigo', '$idpedido', '$cantidad', '$total')";

if($conn->query($sql)){
    echo "Producto agregado al carrito";
    header("location: miCarrito.php?idPedido=".$idpedido);
}else{
    echo "El producto ya se agregó";
    echo "<a href='miCarrito.php?idPedido=$idpedido'>
        <button>Volver a Pedidos</button>
      </a>";
}

$conn->close();
?>