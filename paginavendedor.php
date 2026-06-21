<?php
session_start();
$nombre = $_SESSION['Nombre'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/vendedor.css">
    <style>
        a{
            text-decoration:none;
        }
    </style>
</head>
<body>
    

     
     <?php include 'header.php'; ?>

<div class="saludo">
    <h1>¡Hola, <?php echo $nombre; ?>!</h1>
    <p>Bienvenido/a de nuevo.</p>
</div>
     <div class="a">
       
            <div class="ab">
                    <a href="Pedidos/leerpedido.php">    
            <div class="at">
                <a href="Pedidos/leerpedido.php">
                <p>Pedidos Hoy</p>
                <h1>5</h1>
                </div>
                <img class="imga" src="imagenes/bolsa-de-la-compra.png" alt="">
            </div>
            </a>
            <a href="Productos/leerproductos.php">
            <div class="ab">
                <div class="at">
                <p>Stock</p>
                <h1>35</h1>
                </div>
            <img class="imga" src="imagenes/galleta.png" alt="">
            </div>
            </a>
            <a href="Pedidos/crearpedido.php">
            <div class="ab">
                <div class="at">
                <p>Ingresar pedidos</p>
                <h1>+</h1>
                </div>
                <img class="imga" src="imagenes/portapapeles.png" alt="">
            </div>
            </a>
            <a href="Usuarios/cerrarsesion.php">
            <div class="ab">
                <div class="at">
                
                <h1>Cerrar Sesión</h1>
                </div>
                <img class="imga" src="imagenes/cerrar-sesion.png" alt="">
            </div>
        </a>
     </div>


    <div class="b">
        <div class="ba">
            <div class="bb">
                <h1>Pedidos</h1>
                <img class="bb-img" src="imagenes/bolsa-de-la-compra.png" alt="">
            </div>
            <div class="bf">
            <div class="bg">
            <div class="bc">
                <h2>Pedido #001</h2>
                <p>Maria Gonzales</p>
            </div>
            <div class="bd">
                <h3>Bs80.00 </h3>
                <p>13 may 2026</p>
                <p>10:30AM</p>
            </div>
            </div>
            <div class="be">
                <p>Productos: <br> Brownie x5 <br> Apple pie</p>
            </div>
            </div>
             <div class="bf">
            <div class="bg">
            <div class="bc">
                <h2>Pedido #001</h2>
                <p>Maria Gonzales</p>
            </div>
            <div class="bd">
                <h3>Bs80.00 </h3>
                <p>13 may 2026</p>
                <p>10:30AM</p>
            </div>
            </div>
            <div class="be">
                <p>Productos: <br> Brownie x5 <br> Apple pie</p>
            </div>
            </div>
             <div class="bf">
            <div class="bg">
            <div class="bc">
                <h2>Pedido #001</h2>
                <p>Maria Gonzales</p>
            </div>
            <div class="bd">
                <h3>Bs80.00 </h3>
                <p>13 may 2026</p>
                <p>10:30AM</p>
            </div>
            </div>
            <div class="be">
                <p>Productos: <br> Brownie x5 <br> Apple pie</p>
            </div>
            </div>
             <a href="Pedidos/leerpedido.php">
            <div class="b-boton">
                <h1>Ver Todos Los pedidos</h1>
        </div>
</a>
        </div>
        
    </div>
     <?php include 'footer.php'; ?>

</body>
</html>