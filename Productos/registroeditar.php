<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexion fallida: ".$conexion->connect_error);
}

$Codigo = $_POST['Codigo'];
$NombreProducto = $_POST['NombreProducto'];
$PrecioProducto = $_POST['PrecioProducto'];
$DetalleProducto = $_POST['DetalleProducto'];
$Stock = $_POST['Stock'];
$CostoProducto = $_POST['CostoProducto'];

$sql = "UPDATE Productos SET
Codigo='$Codigo',
NombreProducto='$NombreProducto',
PrecioProducto='$PrecioProducto',
DetalleProducto='$DetalleProducto',
CostoProducto='$CostoProducto',
Stock='$Stock'
WHERE Codigo='$Codigo'";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Producto</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.swal2-container{
    z-index:99999 !important;
}
body{
    background-color: #DAD7CD;
}
</style>

</head>
<body>

<?php include '../header.php'; ?>

<?php
if($conexion->query($sql) == TRUE){
?>

<script>
Swal.fire({
    icon: 'success',
    title: '¡Producto actualizado!',
    text: 'El producto se actualizó con éxito.',
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
    text: 'No se pudo actualizar el producto.',
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