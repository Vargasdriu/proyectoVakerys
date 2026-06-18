
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

                <img src="../imagenes/carrotcakeproc.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/carrotcake2.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/carrotcake3.jpg" onclick="cambiarImagen(this)">

            </section>

            <section class="imagen-principal">

                <img id="imagenPrincipal" src="../imagenes/carrotcakeproc.jpg" alt="Cookie">

            </section>

        </section>

        <section class="info">

            <div class="tag">
                Más vendido
            </div>

            <h1>Carrot cake</h1>

            <div class="linea"></div>

            <section class="estrellas">

                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">
                <img src="../imagenes/estrella.png">

            </section>

            <section class="precio">

                <h2>Bs. 60</h2>
                <p>por unidad</p>

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

                <h3>Descripción</h3>

                <p>
            Suave y esponjoso pastel de zanahoria elaborado de forma artesanal 
            con ingredientes seleccionados. Su textura húmeda y su delicado 
            equilibrio de especias crean un sabor reconfortante y único en
             cada bocado. Perfecto para disfrutar en cualquier momento del 
             día, acompañado de tu bebida favorita.
                </p>

            </section>

            <section class="ingredientes">

                <h3>Ingredientes</h3>

                
   <ul>
    <li>Zanahoria fresca rallada</li>
    <li>Harina de trigo</li>
    <li>Azúcar morena</li>
    <li>Huevos</li>
    <li>Aceite vegetal</li>
    <li>Canela</li>
    <li>Extracto de vainilla</li>
    <li>Queso crema</li>
    <li>Mantequilla</li>
    <li>Azúcar glas</li>
</ul>


            </section>

            <section class="detalle">

                <div class="cuadro">
                    <span>Porciones</span>
                    <h4>8 aprox.</h4>
                </div>

                <div class="cuadro">
                    <span>Peso</span>
                    <h4>1200 gramos</h4>
                </div>

            </section>

            <section class="compra">

                <div class="cantidad">

                    <button>-</button>
                    <span>1</span>
                    <button>+</button>

                </div>

                <a href="carrito.php" class="carrito">
                    Añadir al carrito · Bs. 60
                </a>

            </section>

        </section>

    </section>

    <section class="relacionados">

        <h2>También te puede gustar</h2>

        <section class="cards">
            <a href="brownie.php">
            <div class="card">
                <img src="../imagenes/brownieproc.png">
                <h4>Brownie</h4>
                <p>Bs. 50</p>
            </div>
            </a>

            <a href="cinnamonroll.php">
            <div class="card">
                <img src="../imagenes/cinnamonrollproc.png">
                <h4>Cinnamon Rol</h4>
                <p>Bs. 12</p>
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
