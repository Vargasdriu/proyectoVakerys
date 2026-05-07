<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$sql="SELECT * FROM Productos";
?>
<style>
.tabla-estilo {
border-collapse: collapse;
width: 100%;
text-align: center;
}
.tabla-estilo td {
border: 1px solid #000;
padding: 10px;
}
</style>

<?php
echo "<table border=2 class=tabla-estilo>";
echo "<td>Codigo</td><td>Nombre</td><td>Precio</td><td>Detalle</td><td>Stock</td><td>Costo</td>";
$resultado=$conn->query($sql);
if ($resultado->num_rows > 0){
    while($fila=$resultado->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$fila ['Codigo']."</td><td>".$fila['NombreProducto']."</td><td>".$fila ['PrecioProducto']."</td><td>".$fila ['DetalleProducto']."</td><td>".$fila ['Stock']."</td><td>".$fila ['CostoProducto'];
        $Codigo=$fila['Codigo'];
        echo"</td><td><a href='actualizarproducto.php?Codigo=$Codigo'><button>Editar</button></a>";
        echo "<a href='eliminarproducto.php?Codigo=$Codigo'><button>Eliminar</button></a>";
         echo"<a href='mostrarproducto.php?Codigo=$Codigo'><button>Mostrar</button></a></td></tr>";
        

    }
}
echo"</table>"
?>
<a href="crearproducto.php"><button>Nuevo producto</button></a>
