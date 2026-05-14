<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <link rel="stylesheet" href="estiloscrear.css">
</head>

<body>

    
    <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video>

    
    <div class="capa"></div>

   
    <div class="tra">

        <form action="registrousuario.php" method="post">

            <h2>Bienvenido</h2>

            <label>Carnet de Identidad</label>
            <input type="text" placeholder="CARNET IDENTIDAD" name="CI" required>

            <label>Nombre</label>
            <input type="text" placeholder="NOMBRE(s)" name="Nombre" required>

            <label>Dirección</label>
            <input type="text" placeholder="DIRECCIÓN" name="Direccion" required>

            <label>Número de Celular</label>
            <input type="number" placeholder="NÚMERO DE CELULAR" name="Numero" required>

            <label>Rol</label>
            <input type="text" placeholder="ROL" name="Rol" required>

            <label>Estado</label>
            <input type="text" placeholder="ESTADO" name="Estado" required>

            <input class="button" type="submit" value="Registrar">

        </form>

    </div>

</body>
</html>