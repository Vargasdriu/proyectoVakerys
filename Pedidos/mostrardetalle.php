<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexion fallida: ".$conexion->connect_error);
}


if (!isset($_GET['id'])) {
    header("Location: leerpedido.php");
    exit();
}

$id = $_GET['id'];


$sql = "SELECT * FROM Pedidos WHERE id='$id'";
$resultado = $conexion->query($sql);

$sqlTotal = "SELECT SUM(CostoTotal) AS total FROM carrito WHERE pedidos_id='$id'";
$resultadoTotal = $conexion->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['total'] ?? 0;


$textoQR = "Pedido ID: $id | Total: $$total";
$urlQR = "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=" . urlencode($textoQR);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detalle del Pedido</title>

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
    width:580px;
    padding:40px 40px;
    border-radius:35px;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    border:2px solid rgba(255,255,255,.08);
    backdrop-filter:blur(8px);
}

h1{
    text-align:center;
    font-size:32px;
    margin-bottom:25px;
}

.info{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.info p{
    background:rgba(255,255,255,.08);
    padding:14px 18px;
    border-radius:15px;
    font-size:17px;
}

span{
    font-weight:bold;
    color:#d8f3c3;
}

/* SECCIÓN CÓDIGO QR */
.qr-contenedor{
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(255, 255, 255, .08);
    padding: 20px;
    border-radius: 20px;
    margin-top: 10px;
    text-align: center;
}

.qr-contenedor img{
    border-radius: 12px;
    border: 3px solid #88a07a;
    background: white;
    padding: 5px;
}

.qr-contenedor p{
    background: transparent;
    padding: 0;
    margin-top: 10px;
    font-size: 14px;
    color: #d8f3c3;
}

.boton-centro{
    text-align: center;
}

.boton{
    display:inline-block;
    margin-top:25px;
    background:#88a07a;
    color:white;
    text-decoration:none;
    padding:15px 35px;
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
if($resultado && $resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){
        echo "<p><span>ID Pedido:</span> ".$fila['id']."</p>";
        echo "<p><span>Cliente:</span> ".$fila['Nombre']."</p>";
        echo "<p><span>Fecha:</span> ".$fila['Fecha']."</p>";
        echo "<p><span>Estado:</span> ".$fila['Estado']."</p>";
        echo "<p><span>Vendedor:</span> ".$fila['NombreVendedor']."</p>";
        echo "<p><span>Direccion:</span> ".$fila['Direccion']."</p>";
        echo "<p><span>Telefono:</span> ".$fila['Telefono']."</p>";
        echo "<p><span>Total A Pagar:</span> $".number_format($total, 2)."</p>";
    }

} else {
    echo "<p>No se encontró el pedido.</p>";
}
?>

    <div class="qr-contenedor">
        <img src="<?php echo $urlQR; ?>" alt="Código QR del Pedido">
        <p>Escanear código QR para verificar</p>
    </div>

</div>

<div class="boton-centro">
    <a class="boton" href="leerpedido.php">Volver a Pedidos</a>
</div>

</div>

</body>
</html>