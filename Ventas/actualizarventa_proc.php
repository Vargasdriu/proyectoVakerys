<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error){
    die("Conexion fallida: " . $conexion->connect_error);
}

$pedidos_id = $_POST['pedidos_id'];
$costoTotal = $_POST['costoTotal'];
$Estado = $_POST['Estado'];
$Metodo = $_POST['Metodo'];

$sql = "UPDATE ventas SET 
    costoTotal='$costoTotal',
    Estado='$Estado',
    Metodo='$Metodo'
    WHERE pedidos_id='$pedidos_id'";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Venta</title>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#A3B18A,#588157);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:30px;
}

.contenedor{
    background:rgba(52,78,65,.95);
    width:500px;
    padding:50px;
    border-radius:35px;
    text-align:center;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

h1{
    font-size:35px;
    margin-bottom:20px;
}

p{
    font-size:18px;
    margin-bottom:30px;
}

.boton{
    display:inline-block;
    background:#A3B18A;
    color:#344E41;
    text-decoration:none;
    padding:14px 30px;
    border-radius:18px;
    font-weight:bold;
    transition:.3s;
}

.boton:hover{
    background:white;
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

.error{
    color:#ffb3b3;
}

.exito{
    color:#d8ffd8;
}
</style>
</head>
<body>

<?php include_once '../header.php'; ?>

<div class="contenedor">
<?php
if($resultado){
    echo "<h1 class='exito'>✓ Venta actualizada</h1>";
    echo "<p>Los datos fueron actualizados correctamente.</p>";
}else{
    echo "<h1 class='error'>✕ Error</h1>";
    echo "<p>No se pudo actualizar la venta.</p>";
    echo "<p class='error'>" . $conexion->error . "</p>";
}

$conexion->close();
?>

<a class="boton" href="leerventa.php">Volver</a>
</div>

</body>
</html>