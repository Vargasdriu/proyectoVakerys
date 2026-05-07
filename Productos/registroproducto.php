<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}


$Codigo = $_POST['Codigo'];
$NombreProducto = $_POST['NombreProducto'];
$PrecioProducto = $_POST['PrecioProducto'];
$DetalleProducto  = $_POST['DetalleProducto'];
$Stock = $_POST['Stock'];
$CostoProducto = $_POST['CostoProducto'];
$sql = "INSERT INTO Productos (Codigo, NombreProducto, PrecioProducto, DetalleProducto, Stock, CostoProducto)
VALUES ('$Codigo','$NombreProducto','$PrecioProducto', '$DetalleProducto', '$Stock', '$CostoProducto' )";

if($conn->query($sql) == TRUE){
    echo "Nuevo producto creado con exito.";
}
else{
    echo"Error: ".$sql. "<br>". $conn->error;
}

$conn->close();
?>
