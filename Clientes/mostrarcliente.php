<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
    $CorreoCliente = $_GET['CorreoCliente'];
    $sql="SELECT * FROM Clientes WHERE CorreoCliente='$CorreoCliente'";

    $resultado = $conexion -> query($sql);
    if($resultado -> num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            echo $fila['CorreoCliente']." ".$fila["NombreCliente"]." ".$fila["ApellidoCliente"]." ".$fila["NumeroCliente"];
            $Codigo=$fila['CorreoCliente'];
        }
    }
?>
