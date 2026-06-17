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
</head>

<body>

    <?php include '../header.php'; ?>
    <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video>

    
    <div class="capa"></div>

   
    <div class="tra">

        <form action="registrousuario.php" method="post" onsubmit="return validar()">

            <h2>Bienvenido</h2>

            <label>Carnet de Identidad</label>
            <input type="text" placeholder="CARNET IDENTIDAD" name="CI" id="CI" >

            <label>Nombre</label>
            <input type="text" placeholder="NOMBRE(s)" name="Nombre" id="Nombre" >

            <label>Dirección</label>
            <input type="text" placeholder="DIRECCIÓN" name="Direccion" id="Direccion">

            <label>Número de Celular</label>
            <input type="number" placeholder="NÚMERO DE CELULAR" name="Numero" id="Numero">

            <label>Rol</label>
            <input type="text" placeholder="ROL" name="Rol" id="Rol">

            <label>Estado</label>
            <input type="text" placeholder="ESTADO" name="Estado" id="Estado">

            <input class="button" type="submit" value="Registrar">

        </form>
 <script>
            var a=document.getElementById("CI");
            var b=document.getElementById("Nombre");
            var c=document.getElementById("Direccion");
            var d=document.getElementById("Numero");
            var e=document.getElementById("Rol");
            var f=document.getElementById("Estado");
               var ex=/^[0-9]*$/;
            var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
          
        

         function validar(){

            if(a.value==""){
                alert("este campo no puede ir vacio");
                a.focus();
                return false;
            }
             if(!ex.exec(a.value)){
                alert("introduce solo numeros");
                a.focus();
                return false;
        }

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
             if(!ex.exec(d.value)){
                alert("introduce solo numeros");
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
                if(!expRegNombre.exec(f.value)){
                alert("introduce solo letras");
                f.focus();
                return false;
        }
            else{
            return true;
            }
            
        }
        </script>
    </div>


</body>
</html>
