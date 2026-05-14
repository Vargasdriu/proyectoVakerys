<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";
$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$Codigo=$_GET['Codigo'];
$sql="SELECT * FROM Productos WHERE Codigo='$Codigo'";
$resultado=$conn->query($sql);
    if($resultado->num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            $NombreProducto=$fila['NombreProducto'];
            $PrecioProducto=$fila['PrecioProducto'];
            $DetalleProducto=$fila['DetalleProducto'];
            $Stock=$fila['Stock'];
            $CostoProducto=$fila['CostoProducto'];
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
        <label for="">Codigo del Producto:</label>
        <input type="text" name='Codigo' value='<?=$Codigo?>'> <br>
        <label for="">Nombre del Producto:</label>
        <input type="text" name='NombreProducto' value='<?=$NombreProducto?>'> <br>
        <label for="">Precio del Producto:</label>
        <input type="number" name='PrecioProducto' value='<?=$PrecioProducto?>'> <br>
        <label for="">Detalle del Producto:</label>
        <input type="text" name='DetalleProducto' value='<?=$DetalleProducto?>'> <br>
        <label for="">Stock:</label>
        <input type="number" name='Stock' value='<?=$Stock?>'> <br>
        <label for="">Costo del Producto:</label>
        <input type="number" name='CostoProducto' value='<?=$CostoProducto?>'>
        <input type ="Submit">
</form>
</body>
</html>
