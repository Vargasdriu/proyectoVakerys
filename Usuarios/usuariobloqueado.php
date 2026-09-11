<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuario Bloqueado</title>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;

            background:#DAD7CD;

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;
        }

        /* Personalización de SweetAlert */

        .swal2-popup{
            font-family:'Poppins',sans-serif !important;

            border-radius:28px !important;

            padding:40px !important;

            box-shadow:
                0 20px 50px rgba(52,78,65,.20) !important;
        }

        .swal2-title{
            font-family:'Poppins',sans-serif !important;

            color:#344E41 !important;

            font-size:27px !important;

            font-weight:600 !important;
        }

        .swal2-html-container{
            font-family:'Poppins',sans-serif !important;

            color:#588157 !important;

            font-size:15px !important;

            line-height:1.7 !important;
        }

        .swal2-confirm{
            font-family:'Poppins',sans-serif !important;

            background:#344E41 !important;

            border-radius:12px !important;

            padding:12px 28px !important;

            font-size:14px !important;

            font-weight:600 !important;

            box-shadow:none !important;
        }

        .swal2-confirm:hover{
            background:#3A5A40 !important;
        }

        .swal2-icon.swal2-error{
            border-color:#A3B18A !important;

            color:#588157 !important;
        }

    </style>

</head>


<body>

<?php include '../header.php'; ?>


<script>

Swal.fire({

    icon: 'error',

    title: 'Cuenta bloqueada',

    html: `
        <p>
            Su cuenta está bloqueada y no tiene
            acceso al sistema.
        </p>

        <p style="
            margin-top:10px;
            font-size:13px;
            color:#7A8178;
        ">
            Contacte al administrador para obtener
            acceso nuevamente.
        </p>
    `,

    confirmButtonText: 'Iniciar sesión',

    allowOutsideClick: false,

    allowEscapeKey: false,

    background: '#FFFFFF',

    customClass: {
        popup: 'swal-bloqueado'
    }

}).then((resultado) => {

    if (resultado.isConfirmed) {

        window.location.href = 'login.php';

    }

});

</script>


</body>

</html>
