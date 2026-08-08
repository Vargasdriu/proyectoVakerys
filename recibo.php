<?php
session_start();
require("php/conexion.php");

if(!isset($_SESSION["pedido"])){

    echo "No existe pedido activo";

    exit;

}

$id=$_SESSION["pedido"];
$sql="
SELECT *
FROM pedido
WHERE id='$id'
";

$resultado=$conn->query($sql);
$pedido=$resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Recibo</title>
    <link rel="stylesheet" href="css/ticket.css">
</head>
<body>
    <h1> VAKERY'S</h1>
    <h2>Recibo de pedido</h2>
</body>
</html>
