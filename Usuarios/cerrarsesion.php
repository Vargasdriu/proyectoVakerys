<?php
session_start();
include '../header.php'; 

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
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>
<style>
    .swal2-popup,
.swal2-title,
.swal2-html-container,
.swal2-confirm,
.swal2-cancel {
    font-family: 'Poppins', sans-serif !important;
}
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        video {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            object-position: center;
            display: block;
        }
</style>
</head>

<body>
        <video autoplay muted loop>
            <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
        </video>
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
