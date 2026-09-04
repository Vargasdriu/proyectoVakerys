<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
</head>


<body>

    <h1>Comentarios</h1>

    <?php

    if (file_exists("coment.txt")) {

        $lineas = file("coment.txt");

        for ($i = 0; $i < count($lineas); $i += 4) {

            if (isset($lineas[$i])) {
                $nombre = str_replace("NOMBRE: ", "", trim($lineas[$i]));
            }

            if (isset($lineas[$i + 1])) {
                $asunto = str_replace("ASUNTO: ", "", trim($lineas[$i + 1]));
            }

            if (isset($lineas[$i + 2])) {
                $comentario = str_replace("COMENTARIO: ", "", trim($lineas[$i + 2]));
            }

            echo "
                <div>
                    <h2>" . htmlspecialchars($asunto) . "</h2>
                    <p>" . htmlspecialchars($nombre) . "</p>
                    <p>" . htmlspecialchars($comentario) . "</p>
                </div>
            ";
        }

    } else {
        echo "<p>No hay comentarios todavía.</p>";
    }

    ?>

</body>
</html>