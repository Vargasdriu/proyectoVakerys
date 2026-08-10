<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilos/estilosproductos.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    

<?php include '../header.php'; ?>

<div class="a">

    <span class="subtitulo">
        VAKERY'S · REPOSTERÍA ARTESANAL
    </span>

    <h1>¿Qué se te antoja?</h1>

    <p>
        Repostería artesanal elaborada con ingredientes seleccionados
        para transformar cada momento en una experiencia inolvidable.
    </p>

</div>
<div class="c">
<a href="crearpedidocliente.php">
   <h2>
    Nuevo pedido +
   </h2>

</a>
<h3>Crea un nuevo pedido para añadir productos al carrito</h3>
</div>
<div class="b" id="productos">

</div>

<script src="productos.js"></script>
<script src="carrito.js"></script>
<?php include '../footer.php'; ?>

</body>
</html>