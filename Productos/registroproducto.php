<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

$Codigo = $_POST['Codigo'];
$NombreProducto = $_POST['NombreProducto'];
$PrecioProducto = $_POST['PrecioProducto'];
$DetalleProducto = $_POST['DetalleProducto'];
$Stock = $_POST['Stock'];
$CostoProducto = $_POST['CostoProducto'];

$sql = "INSERT INTO productos
(Codigo, NombreProducto, PrecioProducto, DetalleProducto, Stock, CostoProducto)
VALUES
('$Codigo','$NombreProducto','$PrecioProducto','$DetalleProducto','$Stock','$CostoProducto')";

$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Producto</title>

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
if($conn->affected_rows > 0){
?>

<script>
Swal.fire({
    icon: 'success',
    title: '¡Producto registrado!',
    text: 'El nuevo producto fue creado con éxito.',
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
    text: 'No se pudo registrar el producto.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerproductos.php';
});
</script>

<?php
}

$conn->close();
?>

</body>
</html>