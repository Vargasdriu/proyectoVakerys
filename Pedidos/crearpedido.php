<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUEVO PEDIDO</title>
   <link rel="stylesheet" href="estiloscrear.css">   
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

<label>Ingrese:</label>

<input type="number" placeholder="id" name="id" id="id" >
<input type="text" placeholder="NOMBRE" name="Nombre" id="Nombre" >
<input type="date" placeholder="FECHA" name="Fecha" id="Fecha" >
<input type="text" placeholder="ESTADO" name="Estado" id="Estado" >
<input type="text" placeholder="NOMBRE DE VENDEDOR" name="NombreVendedor" id="NombreVendedor" >
<input class="buttom" type="submit" value="Registrar">

</form>

</div>
<script>
    var a=document.getElementById("id");
    var b=document.getElementById("Nombre");
    var c=document.getElementById("Fecha");
    var d=document.getElementById("Estado");
    var e=document.getElementById("NombreVendedor");
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
