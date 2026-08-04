<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error){
    die("Conexion fallida: " . $conn->connect_error);
}

if(
    isset($_POST['CI']) &&
    isset($_POST['Nombre']) &&
    isset($_POST['Direccion']) &&
    isset($_POST['Numero']) &&
    isset($_POST['Rol']) &&
    isset($_POST['Estado'])
){

    $CI = $_POST['CI'];
    $Nombre = $_POST['Nombre'];
    $Direccion = $_POST['Direccion'];
    $Numero = $_POST['Numero'];
    $Rol = $_POST['Rol'];
    $Estado = $_POST['Estado'];

    $sql = "INSERT INTO GestionDeUsuarios 
    (CI, Nombre, Direccion, Numero, Rol, Estado)
    
    VALUES 
    ('$CI', '$Nombre', '$Direccion', '$Numero', '$Rol', '$Estado')";

    $resultado = $conn->query($sql);

}else{
    $resultado = false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrar Usuario</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:linear-gradient(135deg,#A3B18A,#588157);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:'Poppins',sans-serif;
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
}

h1{
    font-size:35px;
    margin-bottom:20px;
}

p{
    font-size:18px;
    margin-bottom:35px;
}

.boton{
    display:inline-block;
    background:#A3B18A;
    color:#344E41;
    text-decoration:none;
    padding:16px 35px;
    border-radius:18px;
    font-size:18px;
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
<?php include '../header.php'; ?>
<div class="contenedor">

<?php

if($resultado){

    echo "<h1 class='exito'>✓ Usuario Registrado</h1>";
    echo "<p>El nuevo usuario fue creado con éxito.</p>";

}else{

    echo "<h1 class='error'>✕ Error</h1>";
    echo "<p>No se pudo registrar el usuario.</p>";

    if($conn->error){
        echo "<p class='error'>" . $conn->error . "</p>";
    }
}

$conn->close();

?>

<a class="boton" href="leerusuario.php">Volver</a>

</div>

</body>
</html>
