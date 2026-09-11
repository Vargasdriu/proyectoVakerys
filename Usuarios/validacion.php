<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================================
   VERIFICAR SI INICIÓ SESIÓN
========================================= */

if (!isset($_SESSION['Rol'])) {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .swal2-popup {
            font-family: 'Poppins', sans-serif !important;
            border-radius: 20px !important;
        }

        .swal2-title {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 600 !important;
        }

        .swal2-html-container {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
        }

        .swal2-confirm {
            font-family: 'Poppins', sans-serif !important;
            border-radius: 10px !important;
            font-weight: 500 !important;
        }
    </style>
</head>

<body>
<script>
window.onload = function() {

    Swal.fire({
        title: 'Debe iniciar sesión',
        text: 'Para realizar esta acción primero debe iniciar sesión en Vakery’s.',
        icon: 'warning',
        confirmButtonText: 'Ir a iniciar sesión',
        confirmButtonColor: '#344E41'
    }).then(function() {

        window.location.href = 'login.php';

    });

};
</script>

</body>
</html>

<?php
    exit();
}


/* =========================================
   VERIFICAR SI ES ADMINISTRADOR
========================================= */

if ($_SESSION['Rol'] != "administrador") {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .swal2-popup {
            font-family: 'Poppins', sans-serif !important;
            border-radius: 20px !important;
        }

        .swal2-title {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 600 !important;
        }

        .swal2-html-container {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
        }

        .swal2-confirm {
            font-family: 'Poppins', sans-serif !important;
            border-radius: 10px !important;
            font-weight: 500 !important;
        }
    </style>
</head>

<body>

<script>
window.onload = function() {

    Swal.fire({
        title: 'Acceso restringido',
        text: 'Solo el administrador puede realizar esta acción.',
        icon: 'warning',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#344E41'
    }).then(function() {

        window.location.href = 'leerusuario.php';

    });

};
</script>

</body>
</html>

<?php
    exit();
}


/* =========================================
   VERIFICAR CI
========================================= */

if (!isset($_GET['CI'])) {
    header("Location: leerusuario.php");
    exit();
}

$CI = $_GET['CI'];
?>