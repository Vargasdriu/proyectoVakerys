<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $arch=fopen("coment.txt","r");
    while(!feof($arch)){
        $leer=fgets($arch);
        $ver=nl2br($leer);
        echo $ver;
    }
    ?>
</body>
</html>