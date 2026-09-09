<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexion fallida: ".$conexion->connect_error);
}

$id = $_POST['id'];
$Nombre = $_POST['Nombre'];
$Fecha = $_POST['Fecha'];
$Estado = $_POST['Estado'];
$NombreVendedor = $_POST['NombreVendedor'];
$Direccion = $_POST['Direccion'];
$Telefono = $_POST['Telefono'];

$sql = "UPDATE Pedidos SET 
Nombre='$Nombre',
Fecha='$Fecha',
Estado='$Estado',
NombreVendedor='$NombreVendedor',
Direccion='$Direccion',
Telefono='$Telefono'
WHERE id='$id'";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Pedido</title>

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
if($conexion->query($sql) == TRUE){
?>

<script>
Swal.fire({
    icon: 'success',
    title: '¡Pedido actualizado!',
    text: 'El pedido se actualizó con éxito.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerpedido.php';
});
</script>

<?php
}else{
?>

<script>
Swal.fire({
    icon: 'error',
    title: '¡Error!',
    text: 'No se pudo actualizar el pedido.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerpedido.php';
});
</script>

<?php
}
?>

</body>
</html>