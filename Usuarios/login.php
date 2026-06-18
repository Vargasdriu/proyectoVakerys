<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="logininicio.css">
</head>
<body>
    <?php include '../header.php'; ?>
 <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video> 
   
<header>
    
  <div class="capa"></div>

   <div class="tra">
     <form action="validar.php" method="post">

            <h2>Bienvenido</h2>
         <button
    type="button"
    class="google-btn"
    onclick="window.open(
        'https://accounts.google.com/',
        'GoogleLogin',
        'width=500,height=650,left=1000,top=100'
    )">

    <img src="../imagenes/gog.png" alt="Google">
    <h4>Continuar con Google</h4>

</button>
            <label>Nombre </label>
            <input type="text" placeholder="NOMBRE(S) " name="Nombre" id="nombre" >

            <label>CI</label>
            <input type="number" placeholder="CARNET DE IDENTIDAD" name="CI" id="CI">

             <input class="button" type="submit" value="Iniciar Sesion">
             <h4 class="registro">
    ¿No tienes cuenta?
    <button type="button" onclick="window.location.href='CrearUsuario.php'">
        Crea una
    </button>
</h4>

        </form>

    </div>

</header>
 








</form>
</body>
</html>