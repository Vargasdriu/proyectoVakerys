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

<form action="registroproducto.php" method="post" id="CrearProducto">

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.getElementById("CrearProducto").addEventListener("submit", function(event) {
        
        event.preventDefault();
        

    var a=document.getElementById("Codigo");
    var b=document.getElementById("Producto");
    var c=document.getElementById("Precio");
    var d=document.getElementById("Detalle");
    var e=document.getElementById("Costo");
    var f=document.getElementById("Stock");
    var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

     function mostrarAlerta(mensaje, elemento) {
            Swal.fire({
                icon: 'error',
                title: '¡Oops!',
                text: mensaje,
                confirmButtonColor: '#62a38a',
                confirmButtonText: 'Entendido'
            }).then(() => {
                elemento.focus(); 
            });
        }
    

        if(a.value.trim()==""){
          mostrarAlerta("El campo Codigo no puede ir vacío", a);
            return;
        }
        if (!expRegNombre.exec(b.value)) {
            mostrarAlerta("Introduce solo letras en el codigo", a);
            return;
        }
           if (b.value.trim() == "") {
            mostrarAlerta("El campo Producto no puede ir vacío", b);
            return;
        }
           if (c.value.trim() == "") {
            mostrarAlerta("El campo Precio de Venta no puede ir vacío", c);
            return;
        }
        if (d.value.trim() == "") {
            mostrarAlerta("El campo Detalle no puede ir vacío", d);
            return;
        }
        if (e.value.trim() == "") {
            mostrarAlerta("El campo Costo no puede ir vacío", e);
            return;
        }
        if (f.value.trim() == "") {
            mostrarAlerta("El campo Stock no puede ir vacío", f);
            return;
        }

        this.submit();
    });
</script>
</body>
</html>
