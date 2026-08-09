<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexion fallida: ".$conexion->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM Pedidos WHERE id='$id'";

$resultado = $conexion->query($sql);

$sqlTotal = "SELECT SUM(CostoTotal) AS total FROM carrito WHERE pedidos_id='$id'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:linear-gradient(135deg,rgb(163,177,138),rgb(88,129,87));
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:'Raleway',sans-serif;
    padding:30px;
}

.contenedor{
    background:rgba(52,78,65,.95);
    width:550px;
    padding:50px 40px;
    border-radius:35px;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    border:2px solid rgba(255,255,255,.08);
    backdrop-filter:blur(8px);
}

h1{
    text-align:center;
    font-size:35px;
    margin-bottom:35px;
}

.info{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.info p{
    background:rgba(255,255,255,.08);
    padding:15px 18px;
    border-radius:15px;
    font-size:18px;
}

span{
    font-weight:bold;
    color:#d8f3c3;
}

.boton{
    display:inline-block;
    margin-top:35px;
    background:#88a07a;
    color:white;
    text-decoration:none;
    padding:16px 35px;
    border-radius:18px;
    font-size:18px;
    font-weight:bold;
    transition:.3s;
}

.boton:hover{
    background:white;
    color:rgb(52,78,65);
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

</style>

</head>
<body>
<?php include '../header.php'; ?>
<div class="contenedor">

<h1>Información del Pedido</h1>

<div class="info">

<?php
if($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

        echo "<p><span>id:</span> ".$fila['id']."</p>";
        echo "<p><span>Nombre:</span> ".$fila['Nombre']."</p>";
        echo "<p><span>Fecha:</span> ".$fila['Fecha']."</p>";
        echo "<p><span>Estado:</span> ".$fila['Estado']."</p>";
        echo "<p><span>Nombre del Vendedor:</span> ".$fila['NombreVendedor']."</p>";
        echo "<p><span>Direccion:</span> ".$fila['Direccion']."</p>";
        echo "<p><span>Telefono:</span> ".$fila['Telefono']."</p>";

    }

}else{
    echo "<p>No se encontró el pedido.</p>";
}
?>

</div>

<a class="boton" href="leerpedidocliente.php">Volver a Pedidos</a>

</div>

</body>
</html>

