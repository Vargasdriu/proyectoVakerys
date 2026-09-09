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
    $email = "";
    $asunto = "";
    $puntuacion = "";
    $comentario = "";

    foreach ($lineas as $linea) {
        $linea = trim($linea);

        if (strpos($linea, "NOMBRE:") === 0) {
            $nombre = trim(str_replace("NOMBRE:", "", $linea));
        } elseif (strpos($linea, "EMAIL:") === 0) {
            $email = trim(str_replace("EMAIL:", "", $linea));
        } elseif (strpos($linea, "ASUNTO:") === 0) {
            $asunto = trim(str_replace("ASUNTO:", "", $linea));
        } elseif (strpos($linea, "PUNTUACIÓN:") === 0) {
            $puntuacion = trim(str_replace("PUNTUACIÓN:", "", $linea));
        } elseif (strpos($linea, "COMENTARIO:") === 0) {
            $comentario = trim(str_replace("COMENTARIO:", "", $linea));

            $comentarios[] = array(
                "nombre" => $nombre,
                "email" => $email,
                "asunto" => $asunto,
                "puntuacion" => $puntuacion,
                "comentario" => $comentario
            );

            $nombre = "";
            $email = "";
            $asunto = "";
            $puntuacion = "";
            $comentario = "";
        }
    }
}
?>

<div class="contenedor-tres-columnas">

    <!-- COLUMNA 1: LISTA -->
    <div class="columna col-1">
        <h2>Lista</h2>
        <?php
        if (count($comentarios) == 0) {
            echo "<p style='color:#DAD7CD;'>No hay comentarios.</p>";
        }
        for ($i = 0; $i < count($comentarios); $i++) {
        ?>
            <a class="boton-comentario" href="comentarios.php?comentario=<?php echo $i; ?>">
                Comentario <?php echo $i + 1; ?>
            </a>
        <?php } ?>
    </div>

    <?php
    if (count($comentarios) > 0) {
        $numero = isset($_GET["comentario"]) ? intval($_GET["comentario"]) : 0;
        if ($numero < 0 || $numero >= count($comentarios)) {
            $numero = 0;
        }
        $actual = $comentarios[$numero];
    ?>

    <!-- COLUMNA 2: DATOS DEL CLIENTE -->
    <div class="columna col-2">
        <h2>Detalles</h2>
        <div class="tarjeta-info">
            <h3>👤 <?php echo htmlspecialchars($actual["nombre"]); ?></h3>
            <p><strong>📧 Correo:</strong><br><?php echo htmlspecialchars($actual["email"]); ?></p>
            <p><strong>📌 Asunto:</strong><br><?php echo htmlspecialchars($actual["asunto"]); ?></p>
            <p><strong>⭐ Puntuación:</strong><br><?php echo htmlspecialchars($actual["puntuacion"]); ?></p>
        </div>
    </div>

    <!-- COLUMNA 3: BURBUJA COMENTARIO CHAT -->
    <div class="columna col-3">
        <h2>Comentario</h2>
        <div class="chat-container">
            <div class="burbuja-chat">
                <span class="autor-chat"><?php echo htmlspecialchars($actual["nombre"]); ?></span>
                <p><?php echo htmlspecialchars($actual["comentario"]); ?></p>
            </div>
        </div>
    </div>

    <?php } else { ?>
        <div class="columna col-2"><p style="color:#DAD7CD;">Sin datos.</p></div>
        <div class="columna col-3"><p style="color:#DAD7CD;">Sin comentarios.</p></div>
    <?php } ?>

</div>

</body>
</html>