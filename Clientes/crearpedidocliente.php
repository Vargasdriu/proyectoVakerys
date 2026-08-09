<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUEVO PEDIDO</title>

    <link rel="stylesheet" href="../Usuarios/estiloscrear.css">

    <style>
        select#Estado {
            width: 100%;
            padding: 14px;
            margin-top: 12px;
            margin-bottom: 18px;
            border: none;
            border-radius: 14px;
            background: rgba(255,255,255,0.12);
            color: white;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            backdrop-filter: blur(4px);
            box-sizing: border-box;
            cursor: pointer;
        }

        select#Estado option {
            background: #344E41;
            color: #DAD7CD;
            
        }

        select#Estado:focus {
            background: rgba(255,255,255,0.18);
        }
    </style>
</head>
<body>
 <?php include '../header.php'; ?>
  <video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>

<div class="capa"></div>

<div class="tra">

<form action="registropedidocliente.php" method="post" id="crearpedidocliente">

<h2>Nuevo Pedido</h2>


<input type="hidden" placeholder="id" name="id" id="id" >
<label>Nombre:</label>
<input type="text" placeholder="NOMBRE" name="Nombre" id="Nombre" >
<label>Fecha:</label>
<input type="date" placeholder="FECHA" name="Fecha" id="Fecha" value="<?php echo date ('Y-m-d'); ?>"readonly>
<label>Estado:</label>

<select name="Estado" id="Estado">
    <option value="">Seleccionar estado</option>
    <option value="Pendiente">Pendiente</option>
    <option value="En proceso">En proceso</option>
    <option value="Completado">Completado</option>
    <option value="Cancelado">Cancelado</option>
</select>
<input type="hidden" placeholder="NOMBRE DE VENDEDOR" name="NombreVendedor" id="NombreVendedor">
<label>Dirección:</label>
<input type="text" placeholder="DIRECCIÓN" name="Direccion" id="Direccion" >
<label>Teléfono:</label>
<input type="number" placeholder="TELÉFONO" name="Telefono" id="Telefono" >
<input class="button" type="submit" value="Registrar">

</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.getElementById("crearpedidocliente").addEventListener("submit", function(event) {
        
        event.preventDefault();

        var b = document.getElementById("Nombre");
        var c = document.getElementById("Fecha");
        var d = document.getElementById("Estado");
        var e = document.getElementById("Direccion");
        var f = document.getElementById("Telefono");

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
                if (e.value.trim() == "") {
            mostrarAlerta("El campo Dirección no puede ir vacío", e);
            return;
        }
                if (f.value.trim() == "") {
            mostrarAlerta("El campo Teléfono no puede ir vacío", f);
            return;
        }

       
        this.submit();
    });
</script>
</body>
</html>
