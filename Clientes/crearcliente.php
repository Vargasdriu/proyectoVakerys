<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido</title>
  <link rel="stylesheet" href="../Productos/estiloscrear.css">
</head>
<body>

 
  <form action="registrocliente.php" method="post">
    <h2>Bienvenido</h2>

    <label>Ingrese:</label>
    <input type="text" placeholder="CORREO ELECTRÓNICO" name="CorreoCliente" required><br>

    <input type="text" placeholder="NOMBRE(s)" name="NombreCliente" required><br>

    <input type="text" placeholder="APELLIDO(s)" name="ApellidoCliente" required><br>

    <input type="number" placeholder="NUMERO DE CELULAR" name="NumeroCliente" required><br>

    <input class="buttom" type="submit" value="Registrar">

  </form>

</body>
</html>
