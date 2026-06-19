<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

// Crear la conexión con la base de datos
$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

// Verificar si la conexión falló
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Capturar de manera exacta las variables enviadas por el método POST desde formPedido.php
$Nombre = $_POST["Nombre"];
$Fecha = $_POST["Fecha"];
$Estado = $_POST["Estado"];
$NombreVendedor = $_POST["NombreVendedor"];

// LÍNEA 21 CORREGIDA: Nos aseguramos de escribir 'pedidos' en minúscula tal cual está en el script SQL.
// Omitimos la columna 'id' para que MySQL use el AUTO_INCREMENT de forma automática.
$sql = "INSERT INTO pedidos (Nombre, Fecha, Estado, NombreVendedor) VALUES ('$Nombre', '$Fecha', '$Estado', '$NombreVendedor')";

if ($conn->query($sql)) {
    // Al insertarse correctamente, obtenemos el ID autogenerado y redirigimos a miCarrito.php
    header("Location: miCarrito.php?idPedido=" . $conn->insert_id);
    exit();
} else {
    echo "Error al registrar el pedido: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>