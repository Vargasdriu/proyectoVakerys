<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
   <link rel="stylesheet" href="estiloscrear.css">   
</head>
<body>
 <?php include '../header.php'; ?>
  <video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

<form action="registroproducto.php" method="post" onsubmit="return validar()">

<h2>Nuevo Producto</h2>

<label>Ingrese:</label>

<input type="text" placeholder="CODIGO" name="Codigo" id="Codigo" >
<input type="text" placeholder="NOMBRE" name="NombreProducto" id="Producto" >
<input type="number" placeholder="PRECIO DE VENTA" name="PrecioProducto" id="Precio" >
<input type="text" placeholder="DETALLE" name="DetalleProducto" id="Detalle" >
<input type="number" placeholder="COSTO" name="CostoProducto" id="Costo" >
<input type="number" placeholder="STOCK" name="Stock" id="Stock" >
<input class="buttom" type="submit" value="Registrar">

</form>

</div>
<script>
    var a=document.getElementById("Codigo");
    var b=document.getElementById("Producto");
    var c=document.getElementById("Precio");
    var d=document.getElementById("Detalle");
    var e=document.getElementById("Costo");
    var f=document.getElementById("Stock");
    var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    function validar(){

        if(a.value==""){
            alert("este campo no puede ir vacio");
            a.focus();
            return false;
        }
        if(!expRegNombre.exec(a.value)){
                alert("introduce solo letras");
                a.focus();
                return false;
        }
         if(b.value==""){
            alert("este campo no puede ir vacio");
            b.focus();
            return false;
        }
         if(c.value==""){
            alert("este campo no puede ir vacio");
            c.focus();
            return false;
        }
        
         if(d.value==""){
            alert("este campo no puede ir vacio");
            d.focus();
            return false;
        }
         if(e.value==""){
            alert("este campo no puede ir vacio");
            e.focus();
            return false;
        }
         if(f.value==""){
            alert("este campo no puede ir vacio");
            f.focus();
            return false;
        }

    }
</script>
</body>
</html>
