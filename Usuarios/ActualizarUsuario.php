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
$sql="SELECT * FROM GEstionDeUsuarios WHERE CarnetIdentidad='$CarnetIdentidad'";
$resultado=$conn->query($sql);
    if($resultado->num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            $CarnetIdentidad=$fila['CarnetIdentidad'];
            $CarnetIdentidad=$fila['CarnetIdentidad'];
            $DireccionUsuario=$fila['DireccionUsuario'];
            $NumeroUsuario=$fila['NumeroUsuario'];
            $RolUsuario=$fila['RolUsuario'];
            $EstadoUsuario=$fila['EstadoUsuario'];
           
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
        <input type="text" name='CarnetIdentidad' value='<?=$CarnetIdentidad?>'> <br>

        <label for="">Nombre(s):</label>
        <input type="text" name='NombreUsuario' value='<?=$NombreUsuario?>'> <br>

        <label for="">Direción:</label>
        <input type="text" name='DireccionUsuario' value='<?=$DireccionUsuario?>'> <br>

        <label for="">Celular:</label>
        <input type="number" name='NumeroUsuario' value='<?=$NumeroUsuario?>'> <br>

        <label for="">Rol:</label>
        <input type="number" name='RolUsuario' value='<?=$RolUsuario?>'> <br>

        <label for="">Estado:</label>
        <input type="number" name='EstadoUsuario' value='<?=$EstadoUsuario?>'> <br>
        
        <input type ="Submit">
</form>
    
</body>
</html>