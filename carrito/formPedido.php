<?php
    session_start();
   
    $vendedor = $_SESSION['Nombre'] ?? "Vendedor Vakery's";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NUEVO PEDIDO - Vakery's</title>
  <link rel="stylesheet" href="../Usuarios/estiloscrear.css">   
</head>
<body>

 

<form action="nuevo_pedido.php" method="POST" onsubmit="return validar()">

<h2>Nuevo Pedido</h2>

<label>Nombre Cliente:</label>
<input type="text" placeholder="NOMBRE DEL CLIENTE" name="Nombre" id="Nombre" required>

<label>Fecha:</label>
<input type="date" name="Fecha" id="Fecha" value="<?php echo date('Y-m-d'); ?>" readonly>

<input type="hidden" name="Estado" id="Estado" value="En Proceso">

<label>Nombre Vendedor:</label>
<input type="text" placeholder="NOMBRE DE VENDEDOR" name="NombreVendedor" id="NombreVendedor" value="<?php echo $vendedor; ?>" readonly>

<input class="buttom" type="submit" value="Nuevo Pedido">

</form>

</div>

<script>
    var b = document.getElementById("Nombre");
    var c = document.getElementById("Fecha");
    var e = document.getElementById("NombreVendedor");
    var expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

    function validar(){
        if(b.value.trim() == ""){
            alert("El campo Nombre no puede ir vacío");
            b.focus();
            return false;
        }
        if(!expRegNombre.exec(b.value)){
            alert("Introduce solo letras en el nombre del cliente");
            b.focus();
            return false;
        }
        if(c.value == ""){
            alert("El campo Fecha no puede ir vacío");
            c.focus();
            return false;
        }
        if(e.value == ""){
            alert("El campo Nombre Vendedor no puede ir vacío");
            e.focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>