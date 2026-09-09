<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Comentarios</title>
    <link rel="stylesheet" href="comentarios.css">
</head>
<body>

<?php include '../header.php'; ?>

<video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
</video>

<div class="capa"></div>

<?php
// 1. LEER Y AGRUPAR LOS COMENTARIOS POR CORREO
$clientes = array();

if (file_exists("coment.txt")) {
    $lineas = file("coment.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $nombre = "";
    $email = "";
    $asunto = "";
    $puntuacion = "";
    $fecha = "";
    $comentario = "";

    foreach ($lineas as $linea) {
        $linea = trim($linea);

        if (strpos($linea, "NOMBRE:") === 0) {
            $nombre = trim(substr($linea, 7));
        } elseif (strpos($linea, "EMAIL:") === 0) {
            $email = strtolower(trim(substr($linea, 6)));
        } elseif (strpos($linea, "ASUNTO:") === 0) {
            $asunto = trim(substr($linea, 7));
        } elseif (strpos($linea, "PUNTUACIÓN:") === 0) {
            $puntuacion = trim(substr($linea, 12));
        } elseif (strpos($linea, "FECHA:") === 0) {
            $fecha = trim(substr($linea, 6));
        } elseif (strpos($linea, "COMENTARIO:") === 0) {
            $comentario = trim(substr($linea, 11));

            if (!empty($email)) {
                // Si el correo no existe en nuestro array, creamos el cliente
                if (!array_key_exists($email, $clientes)) {
                    $clientes[$email] = array(
                        "nombre" => $nombre,
                        "email" => $email,
                        "mensajes" => array()
                    );
                } else {
                    // Si ya existe, actualizamos el nombre en caso de que viniera vacío
                    if (!empty($nombre)) {
                        $clientes[$email]["nombre"] = $nombre;
                    }
                }

                // Agregamos este mensaje a la lista de mensajes de este mismo cliente
                $clientes[$email]["mensajes"][] = array(
                    "asunto" => $asunto,
                    "puntuacion" => $puntuacion,
                    "fecha" => !empty($fecha) ? $fecha : 'Sin fecha',
                    "comentario" => $comentario
                );
            }

            // Limpiar variables para el siguiente bloque
            $nombre = "";
            $email = "";
            $asunto = "";
            $puntuacion = "";
            $fecha = "";
            $comentario = "";
        }
    }
}

// Convertir de array asociativo a numérico para poder seleccionar por índice
$lista_clientes = array_values($clientes);
?>

<div class="contenedor-tres-columnas">

    <!-- COLUMNA 1: LISTA DE CLIENTES ÚNICOS (Muestra nombres, NO 'Comentario 1') -->
    <div class="columna col-1">
        <h2>Lista</h2>
        <?php
        if (count($lista_clientes) == 0) {
            echo "<p style='color:#DAD7CD; text-align:center;'>No hay comentarios registrados.</p>";
        }
        for ($i = 0; $i < count($lista_clientes); $i++) {
            $cliente_item = $lista_clientes[$i];
            $cantidad_mensajes = count($cliente_item["mensajes"]);
        ?>
            <!-- Ahora el enlace pasa ?cliente=0, ?cliente=1 en vez de ?comentario=X -->
            <a class="boton-comentario" href="comentarios.php?cliente=<?php echo $i; ?>">
                👤 <?php echo htmlspecialchars($cliente_item["nombre"]); ?>
                <span style="display:block; font-size:11px; font-weight:normal; opacity:0.8;">
                    (<?php echo $cantidad_mensajes; ?> <?php echo ($cantidad_mensajes == 1) ? 'mensaje' : 'mensajes'; ?>)
                </span>
            </a>
        <?php } ?>
    </div>

    <?php
    if (count($lista_clientes) > 0) {
        // Obtener el cliente seleccionado por la URL (?cliente=X)
        $index = isset($_GET["cliente"]) ? intval($_GET["cliente"]) : 0;
        if ($index < 0 || $index >= count($lista_clientes)) {
            $index = 0;
        }
        $cliente_actual = $lista_clientes[$index];
    ?>

    <!-- COLUMNA 2: DETALLES DEL CLIENTE SELECCIONADO -->
    <div class="columna col-2">
        <h2>Detalles</h2>
        <div class="tarjeta-info">
            <h3>👤 <?php echo htmlspecialchars($cliente_actual["nombre"]); ?></h3>
            <p style="margin-top:10px;"><strong>Correo:</strong><br><?php echo htmlspecialchars($cliente_actual["email"]); ?></p>
            <p><strong>Total Mensajes:</strong> <?php echo count($cliente_actual["mensajes"]); ?></p>
            
            <hr style="border: 0; border-top: 1px solid #344E41; margin: 15px 0;">
            <p><strong>Asuntos tratados:</strong></p>
            <ul style="padding-left: 18px; margin: 5px 0; font-size: 13px;">
                <?php foreach ($cliente_actual["mensajes"] as $msg) { ?>
                    <li style="margin-bottom: 8px;">
                        <strong><?php echo htmlspecialchars($msg["asunto"]); ?></strong><br>
                        <small>Puntuación: <?php echo htmlspecialchars($msg["puntuacion"]); ?></small>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- COLUMNA 3: COMENTARIOS / TODAS LAS BURBUJAS DE ESTE CLIENTE -->
    <div class="columna col-3">
        <h2>Comentario</h2>
        <div class="chat-container">
            <?php foreach ($cliente_actual["mensajes"] as $msg) { ?>
                <div class="burbuja-chat">
                    <span class="autor-chat"><?php echo htmlspecialchars($cliente_actual["nombre"]); ?></span>
                    <p style="margin: 5px 0; font-size: 14px;"><?php echo htmlspecialchars($msg["comentario"]); ?></p>
                    <span class="fecha-chat">🕒 <?php echo htmlspecialchars($msg["fecha"]); ?></span>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php } else { ?>
        <div class="columna col-2"><p style="color:#DAD7CD; text-align:center;">Sin detalles.</p></div>
        <div class="columna col-3"><p style="color:#DAD7CD; text-align:center;">Sin comentarios.</p></div>
    <?php } ?>

</div>

</body>
</html>