<?php

$conexion = new mysqli("localhost","root","","vakerysss");

if($conexion->connect_error){
    die("Error de conexión");
}


if(isset($_GET['CI'])){

$CI = $_GET['CI'] ?? '';

$stmt = $conexion->prepare(
    "SELECT * FROM GestionDeUsuarios WHERE CI = ?"
);

$stmt->bind_param("s", $CI);

$stmt->execute();

$resultado = $stmt->get_result();


    if($resultado->num_rows > 0){

        $fila = $resultado->fetch_assoc();


        if($fila['Estado']=="activo"){

$stmtEstado = $conexion->prepare(
    "UPDATE GestionDeUsuarios 
     SET Estado = 'bloqueado' 
     WHERE CI = ?"
);

$stmtEstado->bind_param("s", $CI);
$stmtEstado->execute();

        }else{

$stmtEstado = $conexion->prepare(
    "UPDATE GestionDeUsuarios 
     SET Estado = 'activo' 
     WHERE CI = ?"
);

$stmtEstado->bind_param("s", $CI);
$stmtEstado->execute();
        }


    }


}


header("Location: leerusuario.php");


?>