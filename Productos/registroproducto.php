<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

$Codigo = $_POST['Codigo'];
$NombreProducto = $_POST['NombreProducto'];
$PrecioProducto = $_POST['PrecioProducto'];
$DetalleProducto = $_POST['DetalleProducto'];
$Stock = $_POST['Stock'];
$CostoProducto = $_POST['CostoProducto'];

$sql = "INSERT INTO Productos 
(Codigo, NombreProducto, PrecioProducto, DetalleProducto, Stock, CostoProducto)

VALUES 
('$Codigo','$NombreProducto','$PrecioProducto','$DetalleProducto','$Stock','$CostoProducto')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Producto</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:linear-gradient(135deg,rgb(163,177,138),rgb(88,129,87));
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:'Raleway',sans-serif;
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
    border:2px solid rgba(255,255,255,.08);
    backdrop-filter:blur(8px);
}

h1{
    font-size:35px;
    margin-bottom:20px;
}

p{
    font-size:20px;
    margin-bottom:35px;
    opacity:.9;
}

.boton{
    display:inline-block;
    background:#88a07a;
    color:white;
    text-decoration:none;
    padding:16px 35px;
    border-radius:18px;
    font-size:18px;
    font-weight:bold;
    transition:.3s;
}

.boton:hover{
    background:white;
    color:rgb(52,78,65);
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
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

if($conn->query($sql) == TRUE){

    echo "<h1>✓ Producto Registrado</h1>";
    echo "<p>El nuevo producto fue creado con éxito.</p>";

}else{

    echo "<h1>✕ Error</h1>";
    echo "<p>".$conn->error."</p>";

}

$conn->close();

?>

<a class="boton" href="leerproductos.php">Volver a Productos</a>

</div>

</body>
</html>
