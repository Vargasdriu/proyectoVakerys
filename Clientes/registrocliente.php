<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}


   
    $CorreoCliente=$_POST['CorreoCliente'];
    $NombreCliente=$_POST['NombreCliente'];
    $ApellidoCliente=$_POST['ApellidoCliente'];
    $NumeroCliente=$_POST['NumeroCliente'];
$sql = "INSERT INTO Clientes (CorreoCliente, NombreCliente, ApellidoCliente, NumeroCliente)
VALUES ('$CorreoCliente','$NombreCliente','$ApellidoCliente', '$NumeroCliente')";

if($conn->query($sql) == TRUE){
    echo "Nuevo producto creado con exito.";
}
else{
    echo"Error: ".$sql. "<br>". $conn->error;
}

$conn->close();
?>
