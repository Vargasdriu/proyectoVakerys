<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";
$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$CorreoCliente=$_GET['CorreoCliente'];
$sql="SELECT * FROM Clientes WHERE CorreoCliente='$CorreoCliente'";
$resultado=$conn->query($sql);
    if($resultado->num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            $CorreoCliente=$fila['CorreoCliente'];
            $NombreCliente=$fila['NombreCliente'];
            $ApellidoCliente=$fila['ApellidoCliente'];
            $NumeroCliente=$fila['NumeroCliente'];
           
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="estilosupdate.css">

</head>
<body>
    
    <form action="registroeditar.php" method="post">
        <h2>Actualizar producto:</h2>
        <label for="">Correo Electronico:</label>
        <input type="text" name='CorreoCliente' value='<?=$CorreoCliente?>'> <br>

        <label for="">Nombre(s):</label>
        <input type="text" name='NombreCliente' value='<?=$NombreCliente?>'> <br>

        <label for="">Apellido(s):</label>
        <input type="text" name='ApellidoCliente' value='<?=$ApellidoCliente?>'> <br>

        <label for="">Numero telefónico:</label>
        <input type="number" name='NumeroCliente' value='<?=$NumeroCliente?>'> <br>
        
        <input type ="Submit">
</form>
</body>
</html>
