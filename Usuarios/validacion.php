<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['Rol'])) {
    echo "
    <script>
        alert('Debe iniciar sesión primero.');
        window.location.href='login.php';
    </script>
    ";
    exit();
}


if ($_SESSION['Rol'] != "administrador") {
    echo "
    <script>
        alert('Solo el administrador puede realizar esta acción.');
        window.location.href='leerusuario.php';
    </script>
    ";
    exit();
}

if (!isset($_GET['CI'])) {
    header("Location: leerusuario.php");
    exit();
}

$CI = $_GET['CI'];
?>