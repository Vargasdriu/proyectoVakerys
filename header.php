
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['Rol'] ?? '';

switch ($rol) {

    case 'administrador':
        include __DIR__ . '/headers/headeradmin.php';
        break;

    case 'vendedor':
        include __DIR__ . '/headers/headervendedor.php';
        break;

    default:
        include __DIR__ . '/headers/headeruser.php';
        break;
}

?>

