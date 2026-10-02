<?php

session_start();

$textoGrande = $_SESSION['textoGrande'] ?? false;
$altoContraste = $_SESSION['altoContraste'] ?? false;
$navegacionTeclado = $_SESSION['navegacionTeclado'] ?? false;
$voz = $_SESSION['voz'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos | Vakery's</title>

    <link rel="stylesheet" href="../estilos/estilosproductos.css">

    <?php if($textoGrande){ ?>
        <link rel="stylesheet" href="../estilosaccesibilidad/texto-grandepp.css">
    <?php } ?>

    <?php if($altoContraste){ ?>
        <link rel="stylesheet" href="../estilosaccesibilidad/alto-contrastepp.css">
    <?php } ?>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="<?php

if($textoGrande){
    echo 'texto-grande ';
}

if($altoContraste){
    echo 'alto-contraste ';
}

if($navegacionTeclado){
    echo 'navegacion-teclado ';
}

if($voz){
    echo 'voz-activa ';
}

?>">

<?php include '../header.php'; ?>

<main>

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


<div class="sorpresa-section">

    <div class="sorpresa-contenido">

        <div class="sorpresa-texto">

            <span>
                VAKERY'S · UNA ELECCIÓN DIFERENTE
            </span>

            <h2>
                ¿No sabes qué pedir?
            </h2>

            <p>
                Déjate sorprender por Vakery's y descubre uno de nuestros postres disponibles.
            </p>

            <button type="button" id="btnSorprendeme">
                ✦ Sorpréndeme
            </button>

        </div>

    </div>

</div>


<div class="b" id="productos">
</div>


<div class="s">

    <h2>
        Consulta el estado de tu pedido
    </h2>

    <form action="consultar_pagina.php" method="GET">

        <input
            type="number"
            name="id"
            placeholder="Número de pedido"
            min="1"
            required
        >

        <br>

        <button type="submit">
            Consultar pedido
        </button>

    </form>

</div>


<div id="modalSorpresa" class="modal-sorpresa">

    <div class="modal-sorpresa-contenido">

        <button
            type="button"
            class="cerrar-sorpresa"
            id="cerrarSorpresa"
        >
            ×
        </button>


        <div id="sorpresaCargando">

            <span class="sorpresa-decoracion">
                ✦
            </span>

            <h2>
                Buscando tu sorpresa...
            </h2>

            <p>
                Estamos seleccionando el postre perfecto para ti.
            </p>

            <div class="sorpresa-imagenes">

                <div></div>
                <div></div>
                <div></div>
                <div></div>

            </div>

            <div class="sorpresa-puntos">

                <span class="activo"></span>
                <span></span>
                <span></span>
                <span></span>

            </div>

        </div>


        <div
            id="sorpresaResultado"
            class="sorpresa-resultado"
        >

            <span class="sorpresa-decoracion">
                ✦
            </span>

            <h2>
                ¡Tu sorpresa es...!
            </h2>

            <img
                id="imagenSorpresa"
                src=""
                alt="Producto sorpresa"
            >

            <div class="sorpresa-info">

                <h3 id="nombreSorpresa"></h3>

                <p id="descripcionSorpresa"></p>

                <strong id="precioSorpresa"></strong>

                <div class="sorpresa-botones">

                    <a
                        id="verProductoSorpresa"
                        href="#"
                    >
                        Ver producto
                    </a>

                    <button
                        type="button"
                        id="agregarSorpresa"
                    >
                        Agregar al carrito
                    </button>

                </div>

            </div>


            <button
                type="button"
                id="otraSorpresa"
                class="otra-sorpresa"
            >
                ↻ ¿No te convence? Sorpréndeme otra vez
            </button>

        </div>

    </div>

</div>

</main>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="js/productos.js"></script>
<script src="js/carrito.js"></script>
<script src="js/sorpresa.js"></script>

<script src="../accesibilidad.js"></script>


<?php include '../footer.php'; ?>

</body>

</html>