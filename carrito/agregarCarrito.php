<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: miCarrito.php");
    exit();
}

$codigo = $_POST["codigo"];
$idpedido = (int)$_POST["idpedido"];
$cantidad = (int)$_POST["cantidad"];
$precio = (float)$_POST["precio"];
$total = $precio * $cantidad;

$stmt = $conn->prepare("SELECT Stock FROM productos WHERE Codigo = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    header("Location: miCarrito.php?idPedido=$idpedido&error=producto");
    exit();
}

$fila = $resultado->fetch_assoc();

if ($fila["Stock"] < $cantidad) {
    header("Location: miCarrito.php?idPedido=$idpedido&error=stock");
    exit();
}

$stmt = $conn->prepare("
    INSERT INTO carrito (productos_Codigo, pedidos_id, Cantidad, CostoTotal)
    VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
        Cantidad = Cantidad + VALUES(Cantidad),
        CostoTotal = CostoTotal + VALUES(CostoTotal)
");

$stmt->bind_param("siid", $codigo, $idpedido, $cantidad, $total);

if ($stmt->execute()) {

    $stmt = $conn->prepare("
        UPDATE productos
        SET Stock = Stock - ?
        WHERE Codigo = ?
    ");

    $stmt->bind_param("is", $cantidad, $codigo);
    $stmt->execute();

    header("Location: miCarrito.php?idPedido=$idpedido&success=1");
    exit();

} else {

    header("Location: miCarrito.php?idPedido=$idpedido&error=bd");
    exit();

}

$conn->close();
?>