<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli ($servername, $username, $password, $bdname);
if($conn -> connect_error){
    die ("Conexion fallida:".$conn->connect_error);
}
$sql="SELECT * FROM GestionDeUsuarios";
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
echo "<td>CI</td><td>Nombre</td><td>Direccion</td><td>Celular</td><td>Rol</td><td>Estado</td>";
$resultado=$conn->query($sql);
if ($resultado->num_rows > 0){
    while($fila=$resultado->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$fila ['CI']."</td><td>".$fila['Nombre']."</td><td>".$fila ['Direccion']."</td><td>".$fila ['Numero']."</td><td>".$fila ['Rol']."</td><td>".$fila ['Estado'];
        $CI=$fila['CI'];
        echo"</td><td><a href='actualizarusuario.php?CI=$CI'><button>Editar</button></a>";
        echo "<a href='eliminarusuario.php?CI=$CI'><button>Eliminar</button></a>";
         echo"<a href='mostrarusuario.php?CI=$CI'><button>Mostrar</button></a></td></tr>";
        

    }
}
echo"</table>"
?>
<a href="crearusuario.php"><button>Nuevo cliente</button></a>














































?>