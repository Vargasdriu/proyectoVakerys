
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Chips Cookie | Vakery's</title>

    <link rel="stylesheet" href="estilosproductos.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<?php include_once "../header.php"; ?>

<div class="contenedor">

    <a href="javascript:history.back()" class="volver">
        ← Volver al catálogo
    </a>

    <section class="producto">

        <section class="galeria">

            <section class="miniaturas">

                <img src="../imagenes/cheesecakeproc.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/cheesecake2.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/cheesecake3.jpg" onclick="cambiarImagen(this)">

            </section>

            <section class="imagen-principal">

                <img id="imagenPrincipal" src="../imagenes/cheesecakeproc.jpg" alt="Cookie">

            </section>

        </section>

        <section class="info">

            <div class="tag">
                Más vendido
            </div>

            <h1>Passion fruit cheesecake</h1>

            <div class="linea"></div>

            <section class="estrellas">

                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">

            </section>

            <section class="precio">

                <h2>Bs. 65</h2>
                <p>por unidad</p>

            </section>

            <section class="stats">

                <div>
                    <h4>5</h4>
                    <p>Valoración</p>
                </div>

                <div>
                    <h4>120+</h4>
                    <p>Vendidas</p>
                </div>

                <div>
                    <h4>24h</h4>
                    <p>Entrega</p>
                </div>

            </section>

            <section class="descripcion">

                <h3>Descripción</h3>

                <p>
    Cremoso cheesecake artesanal elaborado con una suave 
    mezcla de queso crema sobre una base de galleta 
    dorada y crujiente. Coronado con una delicada 
    cobertura de maracuyá, combina a la perfección la 
    dulzura y el toque cítrico característico de esta 
    fruta tropical, ofreciendo una experiencia fresca 
    y equilibrada en cada bocado.
</p>
            </section>

            <section class="ingredientes">

                <h3>Ingredientes</h3>

                
  <ul>
    <li>Queso crema</li>
    <li>Maracuyá natural</li>
    <li>Galletas trituradas</li>
    <li>Mantequilla</li>
    <li>Azúcar</li>
    <li>Huevos</li>
    <li>Crema de leche</li>
    <li>Extracto de vainilla</li>
    <li>Gelatina sin sabor (según preparación)</li>
</ul>


            </section>

            <section class="detalle">

                <div class="cuadro">
                    <span>Porciones</span>
                    <h4>8 aprox.</h4>
                </div>

                <div class="cuadro">
                    <span>Peso</span>
                    <h4>1300 gramos</h4>
                </div>

            </section>

            <section class="compra">

                <div class="cantidad">

                    <button>-</button>
                    <span>1</span>
                    <button>+</button>

                </div>

                <a href="carrito.php" class="carrito">
                    Añadir al carrito · Bs. 65
                </a>

            </section>

        </section>

    </section>

    <section class="relacionados">

        <h2>También te puede gustar</h2>

        <section class="cards">
            <a href="carrotcake.php">
            <div class="card">
                <img src="../imagenes/carrotcakeproc.jpg">
                <h4>Carrot cake</h4>
                <p>Bs. 60</p>
            </div>
            </a>

            <a href="lemonpie.php">
            <div class="card">
                <img src="../imagenes/lemonpieproc.jpg">
                <h4>Lemon pie</h4>
                <p>Bs. 60</p>
            </div>
            </a>

            <a href="cookie.php">
            <div class="card">
                <img src="../imagenes/cookie2.jpg">
                <h4>Chocolate chips cookie</h4>
                <p>Bs. 60</p>
            </div>
            </a>
        </section>

    </section>

</div>

<script>
function cambiarImagen(img){
    document.getElementById("imagenPrincipal").src = img.src;
}
</script>
<?php include_once "../footer.php"; ?>
</body>
</html>
