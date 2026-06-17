<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin-top: 100px
        }
    </style>

</head>
<body>
    <?php include '../header.php'; ?>

    <form action="validar.php" method="post">
        <label for="">Nombre</label>
        <input type="text" name="Nombre">
        <br>
        <label for="">CI</label>
        <input type="number" name="CI">
        <br>
        <input type="submit" value="Iniciar Sesión">
</form>
</body>
</html>