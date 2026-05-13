<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";
$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$CarnetIdentidad=$_GET['CarnetIdentidad'];
$sql="SELECT * FROM GEstionDeUsuarios WHERE CI='$CI'";
$resultado=$conn->query($sql);
    if($resultado->num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            $CI=$fila['CI'];
            $Nombre=$fila['Nombre'];
            $Direccion=$fila['Direccion'];
            $Numero=$fila['Numero'];
            $Rol=$fila['Rol'];
            $Estado=$fila['Estado'];
           
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="estilosupdate.css">
</head>
<body>
    <form action="registroeditar.php" method="post">
        <h2>Actualizar usuario:</h2>
        <label for="">Carnet Identidad:</label>
        <input type="text" name='CI' value='<?=$CI?>'> <br>

        <label for="">Nombre(s):</label>
        <input type="text" name='Nombre' value='<?=$Nombre?>'> <br>

        <label for="">Direción:</label>
        <input type="text" name='Direccion' value='<?=$Direccion?>'> <br>

        <label for="">Celular:</label>
        <input type="number" name='Numero' value='<?=$Numero?>'> <br>

        <label for="">Rol:</label>
        <input type="text" name='Rol' value='<?=$Rol?>'> <br>

        <label for="">Estado:</label>
        <input type="text" name='Estado' value='<?=$Estado?>'> <br>
        
        <input type ="Submit">
</form>
</head>
<body>
    
</body>
</html>