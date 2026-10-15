<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['Rol'])) {

    $Rol = $_SESSION['Rol'];

    if ($Rol == 'administrador' || $Rol == 'vendedor') {
        // Puede ingresar
    } 

} else {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title:"Acceso denegado",
                    text : "Debes iniciar sesión para ingresar",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                }).then(function() {
                window.history.back();             
   });
            });
        </script>
    </body>
    </html>';
    exit();
}
?>