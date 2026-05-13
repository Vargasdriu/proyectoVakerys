<?php
   $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
   
    $CI=$_POST['CI'];
    $Nombre=$_POST['Nombre'];
    $Direccion=$_POST['Direccion'];
    $Numero=$_POST['Numero'];
    $Rol=$_POST['Rol'];
    $Estado=$_POST['Estado'];

    $sql = "UPDATE Clientes SET CI = '$CI', Nombre='$Nombre', Direccion='$Direccion', Direccion='$Direccion', Direccion='$Direccion' WHERE CI=$CI";
    if($conexion -> query($sql) == TRUE ){
        echo "El producto se actalizó con exito: ";
    }






?>