<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bdname = "vakerysss";

    $conexion = new mysqli($servername, $username, $password, $bdname);

    if ($conexion->connect_error){
        die("Conexion fallida: ". $conexion->connect_error);
    }
    $Codigo=$_POST['Codigo'];
    $NombreProducto=$_POST['NombreProducto'];
    $PrecioProducto=$_POST['PrecioProducto'];
    $DetalleProducto =$_POST['DetalleProducto'];
    $Stock=$_POST['Stock'];
    $CostoProducto=$_POST['CostoProducto'];

    $sql = "UPDATE Productos SET Codigo = '$Codigo', NombreProducto='$NombreProducto', PrecioProducto='$PrecioProducto', DetalleProducto = '$DetalleProducto', CostoProducto = '$CostoProducto', Stock = '$Stock' WHERE Codigo=$Codigo";
    if($conexion -> query($sql) == TRUE ){
        echo "El producto se actalizó con exito: ";
    }
    ?>
