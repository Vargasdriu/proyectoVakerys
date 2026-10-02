<?php
session_start();

if(isset($_POST['accion'])){

    if($_POST['accion'] == 'texto'){
        $_SESSION['textoGrande'] = !($_SESSION['textoGrande'] ?? false);
    }

    if($_POST['accion'] == 'contraste'){
        $_SESSION['altoContraste'] = !($_SESSION['altoContraste'] ?? false);
    }

    if($_POST['accion'] == 'teclado'){
        $_SESSION['navegacionTeclado'] = !($_SESSION['navegacionTeclado'] ?? false);
    }

    if($_POST['accion'] == 'voz'){
        $_SESSION['voz'] = !($_SESSION['voz'] ?? false);
    }
}

$textoGrande = $_SESSION['textoGrande'] ?? false;
$altoContraste = $_SESSION['altoContraste'] ?? false;
$navegacionTeclado = $_SESSION['navegacionTeclado'] ?? false;

$voz = $_SESSION['voz'] ?? false;
?>
<?php include 'header.php'; ?>
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
            transition:0.2s;
            margin-top:105px;
        }

        .contenedor{
            width:90%;
            max-width:900px;
            margin:60px auto 50px;
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
            width:100%;
        }

        .opcion:hover{
            border-color:#1d3021;
            transform:translateY(-2px);
        }

        .opcion:focus{
            outline:4px solid #f4d35e;
            outline-offset:3px;
        }

        .opcion.activo{
            border-color:#3a5a40;
            background:#e6eadf;
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
            font-weight:700;
        }

        .estado{
            margin-top:25px;
            padding:15px;
            border-radius:10px;
            background:#e6eadf;
            color:#1d3021;
            text-align:center;
            font-weight:600;
            line-height:1.5;
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

        body.texto-grande{
            font-size:20px;
        }

        body.texto-grande .cabecera h1{
            font-size:44px;
        }

        body.texto-grande .cabecera p{
            font-size:21px;
        }

        body.texto-grande .opcion h2{
            font-size:23px;
        }

        body.texto-grande .opcion p{
            font-size:18px;
        }

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

        body.alto-contraste .opcion.activo{
            background:#fff;
            color:#000;
        }

        body.alto-contraste .opcion.activo h2,
        body.alto-contraste .opcion.activo p{
            color:#000;
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

        body.navegacion-teclado *:focus{
            outline:4px solid #f4d35e !important;
            outline-offset:4px !important;
        }

        @media(max-width:700px){

            .contenedor{
                margin-top:40px;
            }

            .cabecera h1{
                font-size:30px;
            }

            .cabecera p{
                font-size:16px;
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

?>">

<main class="contenedor">

    <section class="cabecera">

        <h1>Modo accesible</h1>

        <p>
            Vakery's cuenta con herramientas que facilitan la lectura,
            navegación y uso de la página.
        </p>

    </section>

    <section class="panel" aria-label="Opciones de accesibilidad">

        <div class="opciones">

            <form method="POST">

                <input type="hidden" name="accion" value="texto">

                <button type="submit" class="opcion <?php echo $textoGrande ? 'activo' : ''; ?>">

                    <div class="icono">A+</div>

                    <h2>
                        <?php echo $textoGrande ? 'Texto grande activado' : 'Texto más grande'; ?>
                    </h2>

                    <p>
                        Aumenta el tamaño del texto para facilitar su lectura.
                    </p>

                </button>

            </form>

            <form method="POST">

                <input type="hidden" name="accion" value="contraste">

                <button type="submit" class="opcion <?php echo $altoContraste ? 'activo' : ''; ?>">

                    <div class="icono">◐</div>

                    <h2>
                        <?php echo $altoContraste ? 'Alto contraste activado' : 'Alto contraste'; ?>
                    </h2>

                    <p>
                        Cambia los colores de la página para mejorar la visibilidad.
                    </p>

                </button>

            </form>

            <form method="POST">

    <input type="hidden" name="accion" value="voz">

    <button type="submit" class="opcion <?php echo $voz ? 'activo' : ''; ?>" id="escuchar">

        <div class="icono">🔊</div>

        <h2>
            <?php echo $voz ? 'Lectura por voz activada' : 'Escuchar'; ?>
        </h2>

        <p>
            Lee en voz alta la información de las páginas.
        </p>

    </button>

</form>

            <form method="POST">

                <input type="hidden" name="accion" value="teclado">

                <button type="submit" class="opcion <?php echo $navegacionTeclado ? 'activo' : ''; ?>">

                    <div class="icono">TAB</div>

                    <h2>
                        <?php echo $navegacionTeclado ? 'Navegación activada' : 'Navegación con teclado'; ?>
                    </h2>

                    <p>
                        Permite recorrer las opciones utilizando TAB,
                        SHIFT + TAB, ENTER y ESPACIO.
                    </p>

                </button>

            </form>

        </div>

        <div class="estado" role="status" aria-live="polite">

            <?php

            if($textoGrande || $altoContraste || $navegacionTeclado){

                echo "Tienes activadas las siguientes opciones: ";

                $activadas = [];

                if($textoGrande){
                    $activadas[] = "texto grande";
                }

                if($altoContraste){
                    $activadas[] = "alto contraste";
                }

                if($navegacionTeclado){
                    $activadas[] = "navegación con teclado";
                }

                echo implode(", ", $activadas) . ".";

            }else{

                echo "No tienes ninguna opción de accesibilidad activada.";

            }

            ?>

        </div>

    </section>

    <a href="/proyectovakerys/paginadeinicio.php" class="volver">
        Volver a Vakery's
    </a>

</main>

<script src="accesibilidad.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>