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

// Ajustado exactamente a tus campos: productos_Codigo, pedidos_id, Cantidad, CostoTotal
$sql = "INSERT INTO carrito (productos_Codigo, pedidos_id, Cantidad, CostoTotal) 
        VALUES ('$codigo', '$idpedido', '$cantidad', '$total')
         
            Cantidad = Cantidad + VALUES(Cantidad),
            CostoTotal = CostoTotal + VALUES(CostoTotal)"
if($conn->query($sql)){
    header("location: miCarrito.php?idPedido=".$idpedido);
    exit();
}else{
    // Manejo de error amigable en caso de duplicados
    echo "<p>El producto ya se encuentra en el carrito de este pedido.</p>";
    echo "<a href='miCarrito.php?idPedido=$idpedido'><button>Volver al Carrito</button></a>";
}

$conn->close();
?>