<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM GestionDeUsuarios";
?>

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
    margin-top:75px
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

/* BOTONES */

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
    margin-top:20px;
}

</style>
 <?php include '../header.php'; ?>

<div class="contenedor">

    <h1>Gestión de Usuarios</h1>
    <p class="subtitulo">Lista completa de usuarios registrados</p>

<?php

echo "<table class='tabla-estilo'>";

echo "
<tr>
    <th>CI</th>
    <th>Nombre</th>
    <th>Direccion</th>
    <th>Celular</th>
    <th>Rol</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>
";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

        $CI = $fila['CI'];

        echo "<tr>";

        echo "
        <td>".$fila['CI']."</td>
        <td>".$fila['Nombre']."</td>
        <td>".$fila['Direccion']."</td>
        <td>".$fila['Numero']."</td>
        <td>".$fila['Rol']."</td>
        <td>".$fila['Estado']."</td>

       <td>

<a href='actualizarusuario.php?CI=$CI'>
<button class='editar'>Editar</button>
</a>

<a href='mostrarusuario.php?CI=$CI'>
<button class='mostrar'>Mostrar</button>
</a>

";

if($fila['Rol']=="vendedor"){

    if($fila['Estado']=="activo"){

        echo "
        <a href='cambiarestado.php?CI=$CI'>
        <button class='eliminar'>Bloquear</button>
        </a>
        ";

    }

    if($fila['Estado']=="bloqueado"){

        echo "
        <a href='cambiarestado.php?CI=$CI'>
        <button class='editar'>Desbloquear</button>
        </a>
        ";

    }

}

echo "</td>
";

        echo "</tr>";
    }
}

echo "</table>";
?>

<div class="boton-centro">
    <a href="crearusuario.php">
        <button class="nuevo">Nuevo usuario</button>
    </a>
</div>

</div>