<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}


   
    $CI=$_POST['CI'];
    $Nombre=$_POST['Nombre'];
    $Direccion=$_POST['Direccion'];
    $Numero=$_POST['Numero'];
    $Rol=$_POST['Rol'];
    $Estado=$_POST['Estado'];
$sql = "INSERT INTO GestionDeUsuarios (CI, Nombre, Direccion, Numero,Rol, Estado)
VALUES ('$CI','$Nombre','$Direccion', '$Numero','$Rol','$Estado')";

if($conn->query($sql) == TRUE){
    echo "Nuevo producto creado con exito.";
}
else{
    echo"Error: ".$sql. "<br>". $conn->error;
}

$conn->close();




?>