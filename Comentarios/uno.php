<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $nom=$_POST["nom"];
    $asu=$_POST["asu"];
    $come=$_POST["come"];
    $archivo=fopen("coment.txt","w");
        fwrite($archivo,"NOMBRE");
        fwrite($archivo,$nom .PHP_EOL);
        fwrite($archivo,"ASUNTO");
        fwrite($archivo,$asu .PHP_EOL);
        fwrite($archivo,"COMENTARIO");
        fwrite($archivo,$come .PHP_EOL);

        echo "<a href='dos.php'>ir a los comentarios</a>";
    ?>
</body>
</html>