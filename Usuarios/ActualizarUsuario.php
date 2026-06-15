<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$CI = $_GET['CI'] ?? '';

$Nombre = "";
$Direccion = "";
$Numero = "";
$Rol = "";
$Estado = "";

if ($CI != "") {

    $sql = "SELECT * FROM GestionDeUsuarios WHERE CI='$CI'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $CI = $fila['CI'];
            $Nombre = $fila['Nombre'];
            $Direccion = $fila['Direccion'];
            $Numero = $fila['Numero'];
            $Rol = $fila['Rol'];
            $Estado = $fila['Estado'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Usuario</title>

<link rel="stylesheet" href="estilosupdate.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background-image:url("../imagenes/fondooo.png");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;

    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:30px;
    font-family:'Raleway',sans-serif;
}

.contenedor{
    background:rgba(52,78,65,.95);
    width:500px;
    padding:45px;
    border-radius:35px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    color:white;
}

h2{
    text-align:center;
    margin-bottom:30px;
    font-size:32px;
}

form{
    display:flex;
    flex-direction:column;
}

label{
    margin-bottom:8px;
    font-size:16px;
    color:#DAD7CD;
}

input{
    padding:14px;
    border:none;
    border-radius:15px;
    margin-bottom:20px;
    font-size:16px;
    outline:none;
    background:#F8F7F3;
    color:#344E41;
}

input:focus{
    border:2px solid #A3B18A;
}

.boton{
    background:#A3B18A;
    color:#344E41;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.boton:hover{
    background:white;
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}
</style>
</head>

<body>

<?php include_once "../header.php"; ?>

<div class="contenedor">

<form action="registroeditar.php" method="post" onsubmit="return validar()">

    <h2>Actualizar Usuario</h2>

    <input type="hidden" name="CI" id="CI" value="<?=$CI?>">

    <label>Nombre(s):</label>
    <input type="text" name="Nombre" id="Nombre" value="<?=$Nombre?>">

    <label>Dirección:</label>
    <input type="text" name="Direccion" id="Direccion" value="<?=$Direccion?>">

    <label>Celular:</label>
    <input type="text" name="Numero" id="Numero" value="<?=$Numero?>">

    <label>Rol:</label>
    <input type="text" name="Rol" id="Rol" value="<?=$Rol?>">

    <label>Estado:</label>
    <input type="text" name="Estado" id="Estado" value="<?=$Estado?>">

    <input type="submit" value="Actualizar Usuario" class="boton">

</form>

<script>

var a = document.getElementById("CI");
var b = document.getElementById("Nombre");
var c = document.getElementById("Direccion");
var d = document.getElementById("Numero");
var e = document.getElementById("Rol");
var f = document.getElementById("Estado");

var ex = /^[0-9]*$/;
var expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

function validar(){

    if(a.value == ""){
        alert("CI no puede ir vacío");
        a.focus();
        return false;
    }

    if(!ex.test(a.value)){
        alert("CI solo números");
        a.focus();
        return false;
    }

    if(b.value == ""){
        alert("Nombre no puede ir vacío");
        b.focus();
        return false;
    }

    if(!expRegNombre.test(b.value)){
        alert("Nombre solo letras");
        b.focus();
        return false;
    }

    if(c.value == ""){
        alert("Dirección no puede ir vacía");
        c.focus();
        return false;
    }

    if(d.value == ""){
        alert("Número no puede ir vacío");
        d.focus();
        return false;
    }

    if(!ex.test(d.value)){
        alert("Número solo números");
        d.focus();
        return false;
    }

    if(e.value == ""){
        alert("Rol no puede ir vacío");
        e.focus();
        return false;
    }

    if(f.value == ""){
        alert("Estado no puede ir vacío");
        f.focus();
        return false;
    }

    return true;
}

</script>

</div>
</body>
</html>