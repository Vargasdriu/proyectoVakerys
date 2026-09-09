```php
<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error){
    die("Conexion fallida: " . $conexion->connect_error);
}

$CI = $_POST['CI'];
$Nombre = $_POST['Nombre'];
$Direccion = $_POST['Direccion'];
$Numero = $_POST['Numero'];
$Rol = $_POST['Rol'];
$Estado = $_POST['Estado'];

$sql = "UPDATE GestionDeUsuarios SET 
    Nombre='$Nombre',
    Direccion='$Direccion',
    Numero='$Numero',
    Rol='$Rol',
    Estado='$Estado'
    WHERE CI='$CI'";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Actualizar Usuario</title>

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
    title: '¡Usuario actualizado!',
    text: 'Los datos fueron actualizados correctamente.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerusuario.php';
});
</script>

<?php

}else{

?>

<script>
Swal.fire({
    icon: 'error',
    title: '¡Error!',
    text: 'No se pudo actualizar el usuario.',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157'
}).then(() => {
    window.location.href = 'leerusuario.php';
});
</script>

<?php

}

$conexion->close();

?>

</body>
</html>
```
