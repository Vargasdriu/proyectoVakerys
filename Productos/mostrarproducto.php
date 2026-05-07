<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
    $Codigo = $_GET['Codigo'];
    $sql="SELECT * FROM Productos WHERE Codigo='$Codigo'";

    $resultado = $conexion -> query($sql);
    if($resultado -> num_rows > 0){
        while($fila=$resultado->fetch_assoc()){
            echo $fila['Codigo']." ".$fila["NombreProducto"]." ".$fila["PrecioProducto"]." ".$fila["DetalleProducto"]." ".$fila["Stock"]." ".$fila ['CostoProducto'];
            $Codigo=$fila['Codigo'];
        }
    }
?>
