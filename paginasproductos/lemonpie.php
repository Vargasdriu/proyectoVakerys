
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

                <img src="../imagenes/lemonpieproc.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/lemon2.jpg" onclick="cambiarImagen(this)">
                <img src="../imagenes/lemon3.jpg" onclick="cambiarImagen(this)">

            </section>

            <section class="imagen-principal">

                <img id="imagenPrincipal" src="../imagenes/lemonpieproc.jpg" alt="Cookie">

            </section>

        </section>

        <section class="info">

            <div class="tag">
                Más vendido
            </div>

            <h1>Lemon pie</h1>

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
                    <h4>4.9</h4>
                    <p>Valoración</p>
                </div>

                <div>
                    <h4>130+</h4>
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
    Delicado Lemon Pie artesanal elaborado sobre una base de masa 
    crujiente y dorada, relleno con una suave y cremosa mezcla de
     limón que equilibra perfectamente la dulzura y la acidez.
      Coronado con un ligero merengue, ofrece una experiencia 
      fresca, elegante y llena de sabor en cada bocado.
</p>

            </section>

            <section class="ingredientes">

                <h3>Ingredientes</h3>

                <ul>
    <li>Harina de trigo</li>
    <li>Mantequilla</li>
    <li>Azúcar</li>
    <li>Huevos</li>
    <li>Jugo de limón natural</li>
    <li>Ralladura de limón</li>
    <li>Leche condensada</li>
    <li>Claras de huevo</li>
    <li>Una pizca de sal</li>
</ul>
            </section>

            <section class="detalle">

                <div class="cuadro">
                    <span>Porciones</span>
                    <h4>8 aprox.</h4>
                </div>

                <div class="cuadro">
                    <span>Peso</span>
                    <h4>1600 gramos</h4>
                </div>

            </section>

            <section class="compra">

                <div class="cantidad">

                    <button>-</button>
                    <span>1</span>
                    <button>+</button>

                </div>

                <a href="../Pedidos/crearpedido.php" class="carrito">
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

            <a href="carrotcake.php">
            <div class="card">
                <img src="../imagenes/carrotcakeproc.jpg">
                <h4>Carrot cake</h4>
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
