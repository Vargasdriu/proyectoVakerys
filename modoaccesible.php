<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modo accesible | Vakery's</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Raleway',sans-serif;
            background:#f5f6f1;
            color:#1d3021;
            min-height:100vh;
        }

        .contenedor{
            width:90%;
            max-width:900px;
            margin:110px auto 50px;
        }

        .cabecera{
            text-align:center;
            margin-bottom:35px;
        }

        .cabecera h1{
            font-size:36px;
            margin-bottom:12px;
            color:#1d3021;
        }

        .cabecera p{
            font-size:17px;
            line-height:1.6;
            color:#59645b;
        }

        .panel{
            background:white;
            border-radius:20px;
            padding:30px;
            box-shadow:0 5px 20px rgba(0,0,0,.10);
        }

        .opciones{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:18px;
        }

        .opcion{
            border:2px solid #d0d5ca;
            border-radius:15px;
            padding:22px;
            background:#fff;
            text-align:left;
            cursor:pointer;
            font-family:'Raleway',sans-serif;
            transition:.2s ease;
        }

        .opcion:hover{
            border-color:#1d3021;
            transform:translateY(-2px);
        }

        .opcion:focus{
            outline:4px solid #f4d35e;
            outline-offset:3px;
        }

        .opcion h2{
            font-size:19px;
            margin-bottom:8px;
            color:#1d3021;
        }

        .opcion p{
            font-size:14px;
            line-height:1.5;
            color:#59645b;
        }

        .icono{
            font-size:28px;
            margin-bottom:10px;
        }

        .estado{
            margin-top:25px;
            padding:15px;
            border-radius:10px;
            background:#e6eadf;
            color:#1d3021;
            text-align:center;
            font-weight:600;
        }

        .volver{
            display:block;
            width:max-content;
            margin:30px auto 0;
            padding:13px 25px;
            background:#1d3021;
            color:white;
            text-decoration:none;
            border-radius:10px;
            font-weight:600;
            transition:.2s ease;
        }

        .volver:hover{
            background:#29432d;
            transform:translateY(-2px);
        }

        .volver:focus{
            outline:4px solid #f4d35e;
            outline-offset:3px;
        }

        /* TEXTO GRANDE */

        body.texto-grande{
            font-size:30px;
        }

        body.texto-grande .cabecera h1{
            font-size:54px;
        }

        body.texto-grande .cabecera p{
            font-size:31px;
        }

        body.texto-grande .opcion h2{
            font-size:23px;
        }

        body.texto-grande .opcion p{
            font-size:18px;
        }

        /* ALTO CONTRASTE */

        body.alto-contraste{
            background:#000;
            color:#fff;
        }

        body.alto-contraste .cabecera h1,
        body.alto-contraste .cabecera p{
            color:#fff;
        }

        body.alto-contraste .panel{
            background:#000;
            border:2px solid #fff;
        }

        body.alto-contraste .opcion{
            background:#000;
            border:2px solid #fff;
            color:#fff;
        }

        body.alto-contraste .opcion h2,
        body.alto-contraste .opcion p{
            color:#fff;
        }

        body.alto-contraste .estado{
            background:#fff;
            color:#000;
        }

        body.alto-contraste .volver{
            background:#fff;
            color:#000;
        }

        body.alto-contraste .opcion:focus,
        body.alto-contraste .volver:focus{
            outline:4px solid #ffff00;
        }

        /* TECLADO */

        body.navegacion-teclado *:focus{
            outline:4px solid #f4d35e !important;
            outline-offset:4px !important;
        }

        @media(max-width:700px){

            .contenedor{
                margin-top:95px;
            }

            .cabecera h1{
                font-size:30px;
            }

            .opciones{
                grid-template-columns:1fr;
            }

            .panel{
                padding:20px;
            }

        }

    </style>

</head>

<body>

<?php include "header.php"; ?>
    <main class="contenedor">

        <section class="cabecera">

            <h1>Modo accesible</h1>

            <p>
                Vakery's cuenta con herramientas que facilitan la navegación
                y el uso de la página para diferentes usuarios.
            </p>

        </section>

        <section class="panel" aria-label="Opciones de accesibilidad">

            <div class="opciones">

                <button
                    type="button"
                    class="opcion"
                    id="texto"
                    aria-label="Aumentar tamaño del texto">

                    <div class="icono">A+</div>

                    <h2>Texto más grande</h2>

                    <p>
                        Aumenta el tamaño del texto para facilitar su lectura.
                    </p>

                </button>


                <button
                    type="button"
                    class="opcion"
                    id="contraste"
                    aria-label="Activar alto contraste">

                    <div class="icono">◐</div>

                    <h2>Alto contraste</h2>

                    <p>
                        Cambia los colores de la página para mejorar la visibilidad.
                    </p>

                </button>


                <button
                    type="button"
                    class="opcion"
                    id="escuchar"
                    aria-label="Escuchar información de la página">

                    <div class="icono">🔊</div>

                    <h2>Escuchar</h2>

                    <p>
                        Lee en voz alta la información principal de esta página.
                    </p>

                </button>


                <button
                    type="button"
                    class="opcion"
                    id="teclado"
                    aria-label="Activar navegación con teclado">

                    <div class="icono">TAB</div>

                    <h2>Navegación con teclado</h2>

                    <p>
                        Permite recorrer las opciones utilizando TAB y seleccionar
                        con ENTER o ESPACIO.
                    </p>

                </button>

            </div>

            <div
                id="estado"
                class="estado"
                role="status"
                aria-live="polite">

                Selecciona una opción para activar una herramienta.

            </div>

        </section>

        <a
            href="/proyectovakerys/paginadeinicio.php"
            class="volver">

            Volver a Vakery's

        </a>
>
    </main>
<?php include "footer.php"; ?>

    <script>

        const botonTexto = document.getElementById("texto");
        const botonContraste = document.getElementById("contraste");
        const botonEscuchar = document.getElementById("escuchar");
        const botonTeclado = document.getElementById("teclado");
        const estado = document.getElementById("estado");


        botonTexto.addEventListener("click", function(){

            document.body.classList.toggle("texto-grande");

            if(document.body.classList.contains("texto-grande")){

                estado.textContent =
                    "Texto grande activado.";

                botonTexto.setAttribute(
                    "aria-label",
                    "Desactivar texto grande"
                );

            }else{

                estado.textContent =
                    "Texto grande desactivado.";

                botonTexto.setAttribute(
                    "aria-label",
                    "Activar texto grande"
                );

            }

        });


        botonContraste.addEventListener("click", function(){

            document.body.classList.toggle("alto-contraste");

            if(document.body.classList.contains("alto-contraste")){

                estado.textContent =
                    "Alto contraste activado.";

                botonContraste.setAttribute(
                    "aria-label",
                    "Desactivar alto contraste"
                );

            }else{

                estado.textContent =
                    "Alto contraste desactivado.";

                botonContraste.setAttribute(
                    "aria-label",
                    "Activar alto contraste"
                );

            }

        });


        botonTeclado.addEventListener("click", function(){

            document.body.classList.toggle("navegacion-teclado");

            if(document.body.classList.contains("navegacion-teclado")){

                estado.textContent =
                    "Navegación con teclado activada. Usa TAB para avanzar y SHIFT + TAB para retroceder.";

                botonTeclado.setAttribute(
                    "aria-label",
                    "Desactivar navegación con teclado"
                );

            }else{

                estado.textContent =
                    "Navegación con teclado desactivada.";

                botonTeclado.setAttribute(
                    "aria-label",
                    "Activar navegación con teclado"
                );

            }

        });


        botonEscuchar.addEventListener("click", function(){

            if(!("speechSynthesis" in window)){

                estado.textContent =
                    "La función de lectura por voz no está disponible en este navegador.";

                return;

            }

            speechSynthesis.cancel();

            const texto =
                "Bienvenido al modo accesible de Vakery's. " +
                "En esta página puedes aumentar el tamaño del texto, " +
                "activar el alto contraste y utilizar la navegación con teclado. " +
                "Para navegar con teclado utiliza TAB para avanzar, " +
                "SHIFT más TAB para retroceder y ENTER o ESPACIO para seleccionar.";

            const mensaje = new SpeechSynthesisUtterance(texto);

            mensaje.lang = "es-ES";
            mensaje.rate = 0.9;
            mensaje.pitch = 1;

            speechSynthesis.speak(mensaje);

            estado.textContent =
                "Reproduciendo información mediante voz.";

        });

    </script>

</body>

</html>
