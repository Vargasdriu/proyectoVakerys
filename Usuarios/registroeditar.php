<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error){
    die("Conexion fallida: " . $conexion->connect_error);
}

$CI = $_POST['CI'];
$Nombre = $_POST['Nombre'];
$Direccion = $_POST['Direccion'];
$Numero = $_POST['Numero'];
$Rol = $_POST['Rol'];
$Estado = $_POST['Estado'];

$sql = "UPDATE GestionDeUsuarios SET 
    Nombre='$Nombre',
    Direccion='$Direccion',
    Numero='$Numero',
    Rol='$Rol',
    Estado='$Estado'
    WHERE CI='$CI'";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Actualizar Usuario</title>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

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
.main-header{
  width:100%;
  height:75px;
  background:#afc194;

  display:flex;
  justify-content:center;
  align-items:center;

  position:fixed;
  top:0;
  left:0;

  z-index:1000;

  box-shadow:0 4px 10px rgba(0,0,0,.06);
}

.header-logo img{
  height:55px;
}

.btn-nav{
  position:absolute;
  left:20px;
  cursor:pointer;
}

.btn-nav img{
  width:30px;
  transition:.3s;
}

.btn-nav img:hover{
  transform:scale(1.08);
}

#btn-nav{
  display:none;
}
nav{
  position:fixed;
  top:75px;
  left:0;

  width:250px;
  height:100vh;

  background:#1d3021;

  transform:translateX(-100%);
  transition:.4s;
}

#btn-nav:checked ~ nav{
  transform:translateX(0);
}

.menu{
  list-style:none;
}

.menu li{
  border-bottom:1px solid rgba(255,255,255,.1);
}

.menu a{
  color:white;
  text-decoration:none;
  display:block;
  padding:18px;
  transition:.3s;
}

.menu a:hover{
  background:rgba(255,255,255,.1);
  padding-left:30px;
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
<header class="main-header">

    <div class="header-logo">
      <img src="../imagenes/logo.png" alt="Vakery's">
    </div>

    <label for="btn-nav" class="btn-nav">
      <img src="../imagenes/menu.png" alt="Menu">
    </label>

    <input type="checkbox" id="btn-nav">

    <nav>

      <ul class="menu">
        <li><a href="../paginadeinicio.html">Inicio</a></li>
        <li><a href="#">Iniciar sesión</a></li>
        <li><a href="../paginaproductos.html">Productos</a></li>
        <li><a href="#">Promociones</a></li>
        <li><a href="../sobrevakerys1.html">Sobre Vakery's</a></li>
        <li><a href="../paginaadmin.html">Página Administrador</a></li>
      <li><a href="paginavendedor.html">Página Vendedor</a></li>
      </ul>

    </nav>

  </header>
<div class="contenedor">

<?php

if($resultado){

    echo "<h1 class='exito'>✓ Usuario actualizado</h1>";
    echo "<p>Los datos fueron actualizados correctamente.</p>";

}else{

    echo "<h1 class='error'>✕ Error</h1>";
    echo "<p>No se pudo actualizar el usuario.</p>";

    echo "<p class='error'>" . $conexion->error . "</p>";
}

$conexion->close();

?>

<a class="boton" href="leerusuario.php">Volver</a>

</div>

</body>
</html>