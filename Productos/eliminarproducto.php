<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexión fallida: " . $conexion->connect_error);
}

$Codigo = $_GET['Codigo'] ?? '';

$stmtCarrito = $conexion->prepare(
    "DELETE FROM carrito WHERE productos_Codigo = ?"
);

$stmtCarrito->bind_param("s", $Codigo);

$stmtCarrito->execute();


$stmtProducto = $conexion->prepare(
    "DELETE FROM Productos WHERE Codigo = ?"
);

$stmtProducto->bind_param("s", $Codigo);

$resultado = $stmtProducto->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eliminar Producto</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.swal2-container{
    z-index:99999 !important;
}
</style>

</head>
<body>

<?php include '../header.php'; ?>

<?php
if($resultado){
?>

<script>
Swal.fire({
    icon: 'success',
    title: '¡Producto eliminado!',
    text: 'El producto fue eliminado correctamente.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerproductos.php';
});
</script>

<?php
}else{
?>

<script>
Swal.fire({
    icon: 'error',
    title: '¡Error!',
    text: 'No se pudo eliminar el producto.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerproductos.php';
});
</script>

<?php
}
?>

</body>
</html>