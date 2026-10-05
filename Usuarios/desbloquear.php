<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error) {
    die("Error de conexión");
}

include '../header.php';
include_once "validacion.php";

$stmt = $conexion->prepare(
    "UPDATE GestionDeUsuarios 
     SET Estado = 'activo' 
     WHERE CI = ?"
);

$stmt->bind_param("s", $CI);

$stmt->execute();

$conexion->close();
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire({
    title: 'Usuario desbloqueado',
    text: 'El usuario ha sido desbloqueado correctamente.',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#344E41'
}).then(() => {
    window.location.href = 'leerusuario.php';
});
</script>