<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Producto | Vakery's</title>

    <link rel="stylesheet" href="estilosproductos.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<header><?php include '../header.php'; ?></header>
<body>



<a href="javascript:history.back()" class="volver">
    ← Volver al catálogo
</a>


<section class="producto">

    <section class="galeria">

        <section class="miniaturas" id="miniaturas">
        </section>

        <section class="imagen-principal">

            <img 
                id="imagenPrincipal"
                src=""
                alt="Producto"
            >

        </section>

    </section>


    <section class="info">

        <div class="tag">
            Más vendido
        </div>

        <h1 id="nombreProducto"></h1>

        <div class="linea"></div>


        <section class="estrellas">

            <img src="../imagenes/estrella.png">
            <img src="../imagenes/estrella.png">
            <img src="../imagenes/estrella.png">
            <img src="../imagenes/estrella.png">
            <img src="../imagenes/estrella.png">

        </section>


        <section class="precio">

            <h2 id="precioProducto"></h2>

            <p>
                por unidad
            </p>

        </section>


        <section class="stats">

            <div>
                <h4>5</h4>
                <p>Valoración</p>
            </div>

            <div>
                <h4>100+</h4>
                <p>Vendidas</p>
            </div>

            <div>
                <h4>24h</h4>
                <p>Entrega</p>
            </div>

        </section>


        <section class="descripcion">

            <h3>
                Descripción
            </h3>

            <p id="descripcionProducto"></p>

        </section>


        <section class="compra">

            <div class="cantidad">

                <button>-</button>

                <span>1</span>

                <button>+</button>

            </div>

            <a 
                href="../Pedidos/crearpedido.php"
                class="carrito"
                id="botonCarrito"
            >
                Añadir al carrito
            </a>

        </section>

    </section>

</section>





<script src="producto.js"></script>

</body>
<footer>
    <?php include '../footer.php'; ?>
</footer>
</html>