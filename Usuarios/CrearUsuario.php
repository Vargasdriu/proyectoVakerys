<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Productos/estiloscrear.css">
</head>
<body>
     <form action="GestoinDeUsuarios.php" method="post">
    <h2>Bienvenido</h2>

    <label>Ingrese:</label>
    <input type="text" placeholder="CARNET IDENTIDAD" name="CI" required><br>

    <input type="text" placeholder="NOMBRE(s)" name="Nombre" required><br>

    <input type="text" placeholder="DIRECCIÓN" name="Direccion" required><br>

    <input type="number" placeholder="CELULAR" name="Numero" required><br>

    <input type="text" placeholder="ROL" name="Rol" required><br>

    <input type="text" placeholder="ESTADO" name="Estado" required><br>

    <input class="buttom" type="submit" value="Registrar">

  </form>
    
</body>
</html>