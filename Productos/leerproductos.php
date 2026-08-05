<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT * FROM Productos";
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Vakerys</title>

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
    letter-spacing:1px;
}

.tabla-estilo td{
    padding:14px;
    text-align:center;
    background:#F8F7F3;
    border-bottom:1px solid #DAD7CD;
    color:#344E41;
}

.tabla-estilo tr:hover td{
    background:#E8E5DC;
    transition:0.3s;
}

button{
    border:none;
    padding:9px 15px;
    border-radius:12px;
    font-family:'Poppins',sans-serif;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
    margin:2px;
}

.editar{
    background:#A3B18A;
    color:#344E41;
}

.editar:hover{
    background:#8E9F73;
    transform:scale(1.05);
}

.eliminar{
    background:#588157;
    color:white;
}

.eliminar:hover{
    background:#3A5A40;
    transform:scale(1.05);
}

.mostrar{
    background:#DAD7CD;
    color:#344E41;
    border:1px solid #A3B18A;
}

.mostrar:hover{
    background:#A3B18A;
    transform:scale(1.05);
}

.nuevo{
    margin-top:25px;
    background:#344E41;
    color:white;
    font-size:16px;
    padding:12px 22px;
}

.nuevo:hover{
    background:#3A5A40;
    transform:scale(1.05);
}

.boton-centro{
    display:flex;
    justify-content:center;
}

</style>

</head>

<body>
    <?php include '../header.php'; ?>

<div class="contenedor">


<h1>Vakerys</h1>

<p class="subtitulo">
Panel de productos 
</p>

<?php
echo "<table class='tabla-estilo'>";

echo "<tr>
<th>Código</th>
<th>Nombre</th>
<th>Precio</th>
<th>Detalle</th>
<th>Stock</th>
<th>Costo</th>
<th>Imágenes</th>
<th>Acciones</th>
</tr>";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        $Codigo = $fila["Codigo"];

        echo "<tr>";

        echo "<td>".$fila["Codigo"]."</td>";
        echo "<td>".$fila["NombreProducto"]."</td>";
        echo "<td>Bs ".$fila["PrecioProducto"]."</td>";
        echo "<td>".$fila["DetalleProducto"]."</td>";
        echo "<td>".$fila["Stock"]."</td>";
        echo "<td>Bs ".$fila["CostoProducto"]."</td>";

        echo "<td>";

        echo "<a href='verimagenes.php?codigo=".$Codigo."'>
                <button type='button' class='mostrar'>Ver imágenes</button>
              </a>";

        echo "<a href='añadirimagen.php?codigo=".$Codigo."'>
                <button type='button' class='editar'>Agregar</button>
              </a>";

        echo "</td>";

        echo "<td>";

        echo "<a href='actualizarproducto.php?Codigo=".$Codigo."'>
                <button type='button' class='editar'>Editar</button>
              </a>";

        echo "<a href='eliminarproducto.php?Codigo=".$Codigo."'>
                <button type='button' class='eliminar'>Eliminar</button>
              </a>";

        echo "<a href='mostrarproducto.php?Codigo=".$Codigo."'>
                <button type='button' class='mostrar'>Mostrar</button>
              </a>";

        echo "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr>
            <td colspan='8'>No hay productos registrados.</td>
          </tr>";
}

echo "</table>";
?>

<div class="boton-centro">

<a href="crearproducto.php">
<button class="nuevo">Nuevo Producto</button>
</a>

</div>

</div>

</body>
</html>