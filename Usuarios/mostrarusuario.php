<?php
 $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
    $CI = $_GET['CI'];
    $sql="SELECT * FROM GestionDeUsuarios WHERE CI='$CI'";

    $resultado = $conexion -> query($sql);
    if($resultado -> num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            echo $fila['CI']." ".$fila["Nombre"]." ".$fila["Direccion"]." ".$fila["Numero"]." ".$fila["Rol"]." ".$fila["Estado"];
            $Codigo=$fila['CI'];
        }
    }





?>