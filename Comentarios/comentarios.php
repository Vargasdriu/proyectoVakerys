<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comentarios</title>

    <link rel="stylesheet" href="comentarios.css">

</head>

<body>

<?php include '../header.php'; ?>


<video autoplay muted loop>

    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">

</video>


<div class="capa"></div>


<?php

$comentarios = array();

if (file_exists("coment.txt")) {

    $lineas = file("coment.txt", FILE_IGNORE_NEW_LINES);

    $nombre = "";
    $asunto = "";
    $puntuacion = "";
    $comentario = "";

    foreach ($lineas as $linea) {

        $linea = trim($linea);


        // NOMBRE

        if (strpos($linea, "NOMBRE:") === 0) {

            $nombre = trim(str_replace("NOMBRE:", "", $linea));

        }


        // ASUNTO

        elseif (strpos($linea, "ASUNTO:") === 0) {

            $asunto = trim(str_replace("ASUNTO:", "", $linea));

        }


        // PUNTUACIÓN

        elseif (strpos($linea, "PUNTUACIÓN:") === 0) {

            $puntuacion = trim(
                str_replace("PUNTUACIÓN:", "", $linea)
            );

        }


        // COMENTARIO

        elseif (strpos($linea, "COMENTARIO:") === 0) {

            $comentario = trim(
                str_replace("COMENTARIO:", "", $linea)
            );


            // Guardamos el comentario completo

            $comentarios[] = array(

                "nombre" => $nombre,

                "asunto" => $asunto,

                "puntuacion" => $puntuacion,

                "comentario" => $comentario

            );


            // Limpiamos para el siguiente

            $nombre = "";
            $asunto = "";
            $puntuacion = "";
            $comentario = "";

        }

    }

}

?>


<div class="contenedor">


    <!-- IZQUIERDA -->

    <div class="izquierda">

        <h2>Comentarios</h2>


        <?php

        if (count($comentarios) == 0) {

            echo "<p>No hay comentarios.</p>";

        }


        for ($i = 0; $i < count($comentarios); $i++) {

        ?>

            <a
                class="boton-comentario"
                href="comentarios.php?comentario=<?php echo $i; ?>"
            >

                Comentario <?php echo $i + 1; ?>

            </a>

        <?php

        }

        ?>

    </div>



    <!-- DERECHA -->

    <div class="derecha">


        <?php

        if (count($comentarios) > 0) {


            if (isset($_GET["comentario"])) {

                $numero = intval($_GET["comentario"]);

            } else {

                $numero = 0;

            }


            if ($numero < 0 || $numero >= count($comentarios)) {

                $numero = 0;

            }


            $actual = $comentarios[$numero];

        ?>


            <h1>

                Comentario <?php echo $numero + 1; ?>

            </h1>


            <!-- MENSAJE DEL CLIENTE -->

            <div class="mensaje-cliente">

                <h3>

                    👤 <?php

                    echo htmlspecialchars($actual["nombre"]);

                    ?>

                </h3>


                <p>

                    <strong>Asunto:</strong>

                    <?php

                    echo htmlspecialchars($actual["asunto"]);

                    ?>

                </p>


                <p>

                    <strong>Puntuación:</strong>

                    <?php

                    echo htmlspecialchars($actual["puntuacion"]);

                    ?>

                </p>


                <p>

                    <strong>Comentario:</strong>

                </p>


                <p>

                    <?php

                    echo htmlspecialchars($actual["comentario"]);

                    ?>

                </p>

            </div>



            <!-- RESPUESTAS -->

            <h3 class="titulo-respuesta">

                Respuestas

            </h3>


            <?php

            if (file_exists("respuestas.txt")) {

                $respuestas = file(
                    "respuestas.txt",
                    FILE_IGNORE_NEW_LINES
                );


                for ($i = 0; $i < count($respuestas); $i++) {


                    if (strpos($respuestas[$i], "ID:") === 0) {


                        $id = trim(
                            str_replace(
                                "ID:",
                                "",
                                $respuestas[$i]
                            )
                        );


                        if ($id == ($numero + 1)) {


                            if (isset($respuestas[$i + 1])) {


                                $texto = trim(
                                    str_replace(
                                        "RESPUESTA:",
                                        "",
                                        $respuestas[$i + 1]
                                    )
                                );


                                echo "

                                <div class='respuesta'>

                                    <strong>Administrador:</strong>

                                    <p>"
                                    . htmlspecialchars($texto) .
                                    "</p>

                                </div>

                                ";

                            }

                        }

                    }

                }

            }

            ?>



            <!-- FORMULARIO PARA RESPONDER -->

            <form action="responder.php" method="POST">

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $numero + 1; ?>"
                >


                <textarea
                    name="respuesta"
                    placeholder="Escribe una respuesta..."
                    required
                ></textarea>


                <input
                    class="boton-enviar"
                    type="submit"
                    value="Enviar respuesta"
                >

            </form>


        <?php

        } else {

            echo "<h1>No hay comentarios</h1>";

        }

        ?>


    </div>

</div>


</body>

</html>
