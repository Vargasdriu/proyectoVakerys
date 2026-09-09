<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Productos/estiloscrear.css">
</head>
<body>
   
    
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <link rel="stylesheet" href="estiloscrear.css">
    <style>
        select{
    width:100%;
    padding:14px;
    margin-top:12px;
    margin-bottom:18px;
    border:none;
    border-radius:14px;
    background:rgba(255,255,255,0.12);
    color:white;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    outline:none;
    backdrop-filter:blur(4px);
    box-sizing:border-box;
    cursor:pointer;
}

select:focus{
    background:rgba(255,255,255,0.18);
}

select option{
    background:#344E41;
    color:white;
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

       <form action="registrousuario.php" method="post" id="CrearUsuario">

    <h2>Bienvenido</h2>

    <label>Carnet de Identidad</label>
    <input type="text" placeholder="CARNET IDENTIDAD" name="CI" id="CI">

    <label>Nombre</label>
    <input type="text" placeholder="NOMBRE(s)" name="Nombre" id="Nombre">

    <label>Dirección</label>
    <input type="text" placeholder="DIRECCIÓN" name="Direccion" id="Direccion">

    <label>Número de Celular</label>
    <input type="number" placeholder="NÚMERO DE CELULAR" name="Numero" id="Numero">

    <label>Rol</label>

    <select name="Rol" id="Rol">
        <option value="">Seleccionar el rol</option>
        <option value="administrador">Administrador</option>
        <option value="vendedor">Vendedor</option>
    
    </select>

    
    <input type="hidden" placeholder="ESTADO" name="Estado" id="Estado" value="activo">

    <input class="button" type="submit" value="Registrar">

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   
    document.getElementById("CrearUsuario").addEventListener("submit", function(event) {
        
        event.preventDefault();

        var a = document.getElementById("CI");
        var b = document.getElementById("Nombre");
        var c = document.getElementById("Direccion");
        var d = document.getElementById("Numero");
        var e = document.getElementById("Rol");
        var f = document.getElementById("Estado");
        
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

   
        if (a.value.trim() == "") {
            mostrarAlerta("El campo Carnet de Identidad no puede ir vacío", a);
            return;
        }
        if (!ex.exec(a.value)) {
            mostrarAlerta("Introduce solo números en el Carnet de Identidad", a);
            return;
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
            mostrarAlerta("El campo Dirección no puede ir vacío", c);
            return;
        }

        
        if (d.value.trim() == "") {
            mostrarAlerta("El campo Número de Celular no puede ir vacío", d);
            return;
        }
        if (!ex.exec(d.value)) {
            mostrarAlerta("Introduce solo números en el Celular", d);
            return;
        }

    
        if (e.value.trim() == "") {
            mostrarAlerta("El campo Rol no puede ir vacío", e);
            return;
        }
         if (!expRegMinuscula.exec(e.value)) {
            mostrarAlerta("Introduce solo minusculas en el Rol", e);
            return;
        }

        if (f.value.trim() == "") {
            mostrarAlerta("El campo Estado no puede ir vacío", f);
            return;
        }
        if (!expRegNombre.exec(f.value)) {
            mostrarAlerta("Introduce solo letras en el Estado", f);
            return;
        }

       
        this.submit();
    });
</script>
    </div>


</body>
</html>
