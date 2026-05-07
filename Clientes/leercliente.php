<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$sql="SELECT * FROM CLientes";
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
echo "<td>CorreoCliente</td><td>Nombre</td><td>Apellido</td><td>Numero</td>";
$resultado=$conn->query($sql);
if ($resultado->num_rows > 0){
    while($fila=$resultado->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$fila ['CorreoCliente']."</td><td>".$fila['NombreCliente']."</td><td>".$fila ['ApellidoCliente'];
        $CorreoCliente=$fila['CorreoCliente'];
        echo"</td><td><a href='actualizarcliente.php?CorreoCliente=$CorreoCliente'><button>Editar</button></a>";
        echo "<a href='eliminarcliente.php?CorreoCliente=$CorreoCliente'><button>Eliminar</button></a>";
         echo"<a href='mostrarcliente.php?CorreoCliente=$CorreoCliente'><button>Mostrar</button></a></td></tr>";
        

    }
}
echo"</table>"
?>
<a href="crearcliente.php"><button>Nuevo cliente</button></a>
