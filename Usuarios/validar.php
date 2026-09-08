<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername,$username, $password,$bdname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$Nombre = $_POST['Nombre'];
$CI = $_POST['CI'];

$sql = "SELECT * FROM GestionDeUsuarios WHERE Nombre='$Nombre' AND CI='$CI'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $fila = $result->fetch_assoc();

    // Si está bloqueado, lo manda a la pantalla de bloqueo
    if ($fila['Estado'] == "bloqueado") {

        header("Location: usuariobloqueado.php");
        exit();

    } else {

        $_SESSION['Nombre'] = $fila['Nombre'];
        $_SESSION['Rol'] = $fila['Rol'];

        if ($fila['Rol'] == "administrador") {
            header("Location: ../paginaadmin.php");
            exit();

        } elseif ($fila['Rol'] == "vendedor") {
            header("Location: ../paginavendedor.php");
            exit();

        } else {
            ?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Iniciar Sesion</title>

                <link rel="stylesheet" href="logininicio.css">

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <style>
                    html,
                    body {
                        margin: 0;
                        padding: 0;
                        min-height: 100%;
                    }

                    body {
                        min-height: 100vh;
                        display: flex;
                        flex-direction: column;
                    }

                    header {
                        flex: 1;
                    }

                    footer {
                        margin-top: auto;
                    }
                </style>
            </head>

            <body>

                <?php include '../header.php'; ?>

                <video autoplay muted loop>
                    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
                </video>

                <header>

                    <div class="capa"></div>

                </header>

                <?php include '../footer.php'; ?>

                <script>
                    Swal.fire({
                        icon: 'error',
                        title: '¡Oops!',
                        text: 'Rol no reconocido.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Entendido'
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                </script>

            </body>

            </html>

            <?php
            exit();
        }
    }

} else {

    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesion</title>

        <link rel="stylesheet" href="logininicio.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            html,
            body {
                margin: 0;
                padding: 0;
                min-height: 100%;
            }

            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            header {
                flex: 1;
            }

            footer {
                margin-top: auto;
            }
        </style>
    </head>

    <body>

        <?php include '../header.php'; ?>

        <video autoplay muted loop>
            <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
        </video>

        <header>

            <div class="capa"></div>

        </header>

        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Oops!',
                text: 'Nombre o CI incorrectos',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>

    </body>

    </html>

    <?php
    exit();
}

$conn->close();
?>