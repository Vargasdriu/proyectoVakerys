<?php
session_start();

if (isset($_GET['salir'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<script>
Swal.fire({
    title: "¿Quieres cerrar sesión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí",
    cancelButtonText: "No"
}).then((result) => {

    if (result.isConfirmed) {
        window.location.href = "cerrarsesion.php?salir=1";
    } else {
        window.history.back();
    }

});
</script>

</body>
</html>
