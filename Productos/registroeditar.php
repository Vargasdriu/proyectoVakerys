<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexion fallida: ".$conexion->connect_error);
}

$Codigo = $_POST['Codigo'];
$NombreProducto = $_POST['NombreProducto'];
$PrecioProducto = $_POST['PrecioProducto'];
$DetalleProducto = $_POST['DetalleProducto'];
$Stock = $_POST['Stock'];
$CostoProducto = $_POST['CostoProducto'];

$sql = "UPDATE Productos SET 
Codigo='$Codigo',
NombreProducto='$NombreProducto',
PrecioProducto='$PrecioProducto',
DetalleProducto='$DetalleProducto',
CostoProducto='$CostoProducto',
Stock='$Stock'
WHERE Codigo='$Codigo'";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Producto</title>

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
    width:500px;
    padding:50px 40px;
    border-radius:35px;
    text-align:center;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    border:2px solid rgba(255,255,255,.08);
    backdrop-filter:blur(8px);
}

h1{
    font-size:35px;
    margin-bottom:20px;
}

p{
    font-size:20px;
    margin-bottom:35px;
    opacity:.9;
}

.boton{
    display:inline-block;
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

<?php
if($conexion->query($sql) == TRUE){
    echo "<h1>✓ Producto Actualizado</h1>";
    echo "<p>El producto se actualizó con éxito.</p>";
}else{
    echo "<h1>✕ Error</h1>";
    echo "<p>No se pudo actualizar el producto.</p>";
}
?>

<a class="boton" href="leerproductos.php">Volver a Productos</a>

</div>

</body>
