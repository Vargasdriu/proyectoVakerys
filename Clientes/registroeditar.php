<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
   
    $CorreoCliente=$_POST['CorreoCliente'];
    $NombreCliente=$_POST['NombreCliente'];
    $ApellidoCliente=$_POST['ApellidoCliente'];
    $NumeroCliente=$_POST['NumeroCliente'];

    $sql = "UPDATE Clientes SET CorreoCliente = '$CorreoCliente', NombreCliente='$NombreCliente', ApellidoCliente='$ApellidoCliente' WHERE CorreoCliente=$CorreoCliente";
    if($conexion -> query($sql) == TRUE ){
        echo "El producto se actalizó con exito: ";
    }
    ?>
