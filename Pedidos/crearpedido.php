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

<form action="registropedido.php" method="post" id="crearpedido">

<h2>Nuevo Pedido</h2>


<input type="hidden" placeholder="id" name="id" id="id" >
<label>Nombre:</label>
<input type="text" placeholder="NOMBRE" name="Nombre" id="Nombre" >
<label>Fecha:</label>
<input type="date" placeholder="FECHA" name="Fecha" id="Fecha" value="<?php echo date ('Y-m-d'); ?>"readonly>
<label>Estado:</label>
<input type="text" placeholder="ESTADO" name="Estado" id="Estado" >
<label>Nombre Vendedor:</label>
<input type="text" placeholder="NOMBRE DE VENDEDOR" name="NombreVendedor" id="NombreVendedor" value="<?php echo $nombre; ?>"readonly>
<input class="buttom" type="submit" value="Registrar">

</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.getElementById("crearpedido").addEventListener("submit", function(event) {
        
        event.preventDefault();

        var b = document.getElementById("Nombre");
        var c = document.getElementById("Fecha");
        var d = document.getElementById("Estado");
        
        var ex = /^[0-9]*$/;
        var expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
        var expRegMinuscula=/^[a-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;

       
        function mostrarAlerta(mensaje, elemento) {
            Swal.fire({
                icon: 'error',
                title: '¡Oops!',
                text: mensaje,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Entendido'
            }).then(() => {
                elemento.focus(); 
            });
        }
       
        if (b.value.trim() == "") {
            mostrarAlerta("El campo Nombre no puede ir vacío", b);
            return;
        }
        if (!expRegNombre.exec(b.value)) {
            mostrarAlerta("Introduce solo letras en el Nombre", b);
            return;
        }

        
        if (c.value.trim() == "") {
            mostrarAlerta("El campo Fecha no puede ir vacío", c);
            return;
        }
    

        if (d.value.trim() == "") {
            mostrarAlerta("El campo Estado no puede ir vacío", d);
            return;
        }
        if (!expRegNombre.exec(d.value)) {
            mostrarAlerta("Introduce solo letras en el Estado", d);
            return;
        }

       
        this.submit();
    });
</script>
</body>
</html>
