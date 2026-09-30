<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}



$id = $_POST["id"] ?? 0;

$stmt = $conn->prepare(
    "SELECT *
     FROM pedidos
     WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();



if($resultado->num_rows>0){


$pedido=$resultado->fetch_assoc();



echo json_encode([

"ok"=>true,

"pedido"=>$pedido

]);


}else{


echo json_encode([

"ok"=>false

]);


}


?>