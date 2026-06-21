<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="logininicio.css">
</head>
<body>

    <?php include '../header.php'; ?>

    <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video>

    <header>

        <div class="capa"></div>

        <div class="tra">
            <form action="validar.php" method="post">

                <h2>Bienvenido al Equipo Vakery's</h2>

                <label>Nombre: </label>
                <input type="text" placeholder="NOMBRE(S)" name="Nombre" id="nombre">

                <label>CI: </label>
                <input type="number" placeholder="CARNET DE IDENTIDAD" name="CI" id="CI">

                <input class="button" type="submit" value="Iniciar Sesion">

            </form>
        </div>

    </header>

</body>
</html>