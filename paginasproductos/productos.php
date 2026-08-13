<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Productos | Vakery's</title>

    <link
        rel="stylesheet"
        href="../estilos/estilosproductos.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

</head>


<body>


<?php include '../header.php'; ?>


<!-- ==========================================
     ENCABEZADO
========================================== -->

<div class="a">

    <span class="subtitulo">
        VAKERY'S · REPOSTERÍA ARTESANAL
    </span>


    <h1>
        ¿Qué se te antoja?
    </h1>


    <p>
        Repostería artesanal elaborada con ingredientes seleccionados
        para transformar cada momento en una experiencia inolvidable.
    </p>

</div>


<!-- ==========================================
     NUEVO PEDIDO
========================================== -->

<div class="c">

    <a href="crearpedidocliente.php">

        <h2>
            Nuevo pedido +
        </h2>

    </a>


    <h3>
        Crea un nuevo pedido para añadir productos al carrito
    </h3>

</div>


<!-- ==========================================
     PRODUCTOS
========================================== -->

<div
    class="b"
    id="productos"
>
</div>


<!-- ==========================================
     JAVASCRIPT
========================================== -->

<script src="js/productos.js"></script>

<script src="js/carrito.js"></script>


<?php include '../footer.php'; ?>


</body>

</html>