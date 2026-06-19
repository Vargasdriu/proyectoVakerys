<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Captura de datos provenientes del formulario por fila de miCarrito.php
$codigo = $_POST["codigo"];
$idpedido = $_POST["idpedido"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$total = $precio * $cantidad;

// Consulta alineada con las restricciones y nombres exactos de tu tabla 'carrito'
$sql = "INSERT INTO carrito (productos_Codigo, pedidos_id, Cantidad, CostoTotal) 
        VALUES ('$codigo', '$idpedido', '$cantidad', '$total')
        ON DUPLICATE KEY UPDATE 
            Cantidad = Cantidad + VALUES(Cantidad),
            CostoTotal = CostoTotal + VALUES(CostoTotal)";

if($conn->query($sql)){
    // Redirecciona de vuelta para seguir añadiendo más postres deliciosos al mismo pedido
    header("Location: miCarrito.php?idPedido=" . $idpedido);
    exit();
} else {
    echo "Error crítico en el proceso del carrito de compras: " . $conn->error;
}

$conn->close();
?>