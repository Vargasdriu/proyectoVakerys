<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM ventas ORDER BY pedidos_id DESC";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Historial de Ventas</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#DAD7CD;
    padding:35px;
    margin-top:75px;
}

.contenedor{
    background:white;
    padding:35px;
    border-radius:30px;
    box-shadow:0px 10px 25px rgba(52,78,65,0.15);
}

h1{
    text-align:center;
    color:#344E41;
    font-size:38px;
    margin-bottom:5px;
}

.subtitulo{
    text-align:center;
    color:#588157;
    margin-bottom:30px;
    font-size:15px;
}

.tabla-estilo{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:18px;
}

.tabla-estilo th{
    background:#3A5A40;
    color:white;
    padding:15px;
    font-size:15px;
}

.tabla-estilo td{
    padding:14px;
    text-align:center;
    background:#F8F7F3;
    border-bottom:1px solid #DAD7CD;
    color:#344E41;
}

.boton-centro{
    display:flex;
    justify-content:center;
    margin-top:20px;
}

.boton{
    background:#344E41;
    color:white;
    padding:12px 22px;
    border-radius:12px;
    text-decoration:none;
    font-weight:500;
}
</style>
</head>
<body>

<?php include_once "../header.php"; ?>

<div class="contenedor">
    <h1>Historial de Ventas</h1>
    <p class="subtitulo">Registro histórico de transacciones</p>

<?php
echo "<table class='tabla-estilo'>";
echo "
<tr>
    <th>ID Pedido</th>
    <th>Costo Total</th>
    <th>Estado</th>
    <th>Método</th>
</tr>
";

$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0){
    while($fila = $resultado->fetch_assoc()){
        echo "<tr>";
        echo "
        <td>".$fila['pedidos_id']."</td>
        <td>Bs. ".$fila['costoTotal']."</td>
        <td>".$fila['Estado']."</td>
        <td>".$fila['Metodo']."</td>";
        echo "</tr>";
    }
}

echo "</table>";
?>

<div class="boton-centro">
    <a href="leerventa.php" class="boton">Volver a Gestión de Ventas</a>
</div>

</div>
</body>
</html>