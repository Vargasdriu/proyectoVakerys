<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="comen.css" class="me">
</head>
<body>
    <?php include '../header.php'; ?>
  <video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

    <form action="uno.php" method="POST">

    <h2>Comentario</h2>
    
    <label for="">Ingrese:</label>


        <label for="">nombre:</label>
        <input type="text" name="nom" id="">

        <label for="">asunto:</label>
        <input type="text" name="asu" id="">
        
        <label for="">comentario:</label>   
        <input type="text" name="come" id="">

        <input class="button" type="reset" value="borrar">
        <input class="button" type="submit" value="enviar">
    </form>
    
</body>
</html>