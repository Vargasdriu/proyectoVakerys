<?php

$conexion = new mysqli("localhost","root","","vakerysss");

if($conexion->connect_error){
    die("Error de conexión");
}


if(isset($_GET['CI'])){

    $CI = $_GET['CI'];


    $sql = "SELECT * FROM GestionDeUsuarios WHERE CI='$CI'";

    $resultado = $conexion->query($sql);


    if($resultado->num_rows > 0){

        $fila = $resultado->fetch_assoc();


        if($fila['Estado']=="activo"){

            $conexion->query("UPDATE GestionDeUsuarios SET Estado='bloqueado' WHERE CI='$CI'");


        }else{

            $conexion->query("UPDATE GestionDeUsuarios SET Estado='activo' WHERE CI='$CI'");

        }


    }


}


header("Location: leerusuario.php");


?>