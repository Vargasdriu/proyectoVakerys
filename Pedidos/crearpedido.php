<?php
session_start();
$nombre = $_SESSION['Nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUEVO PEDIDO</title>
   <link rel="stylesheet" href="../Usuarios/estiloscrear.css">   
</head>
<body>
 <?php include '../header.php'; ?>
  <video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

<form action="registropedido.php" method="post" onsubmit="return validar()">

<h2>Nuevo Pedido</h2>


<input type="hidden" placeholder="id" name="id" id="id" >
<label>Nombre:</label>
<input type="text" placeholder="NOMBRE" name="Nombre" id="Nombre" >
<label>Fecha:</label>
<input type="date" placeholder="FECHA" name="Fecha" id="Fecha" value="<?php echo date ('Y-m-d'); ?>"readonly>
<input type="hidden" placeholder="ESTADO" name="Estado" id="Estado" >
<label>Nombre Vendedor:</label>
<input type="text" placeholder="NOMBRE DE VENDEDOR" name="NombreVendedor" id="NombreVendedor" value="<?php echo $nombre; ?>"readonly>
<input class="buttom" type="submit" value="Registrar">

</form>

</div>
<script>
    
    var b=document.getElementById("Nombre");
    var c=document.getElementById("Fecha");
    var d=document.getElementById("Estado");
    var e=document.getElementById("NombreVendedor");
    var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    function validar(){

        if(b.value==""){
            alert("este campo no puede ir vacio");
            b.focus();
            return false;
        }
        if(!expRegNombre.exec(b.value)){
                alert("introduce solo letras");
                b.focus();
                return false;
        }
        }
         if(c.value==""){
            alert("este campo no puede ir vacio");
            c.focus();
            return false;
        }
</script>
</body>
</html>
