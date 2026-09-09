<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Comentario</title>
    <link rel="stylesheet" href="comentarios.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include '../header.php'; ?>

    <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video>

    <div class="capa"></div>

    <div class="contenedor-formulario">
        <form action="validar.php" method="POST">
            <h2>Dejar un Comentario</h2>

            <label for="nom">Nombre:</label>
            <input type="text" name="nom" id="nom" class="input-form">

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="input-form">

            <label for="asu">Asunto:</label>
            <select name="asu" id="asu" class="input-form" onchange="mostrarSubasuntos()">
                <option value="">Seleccionar asunto</option>
                <option value="Queja">Queja</option>
                <option value="Recomendaciones">Recomendaciones</option>
            </select>

            <!-- Sub-asunto para Queja -->
            <div id="grupo-queja" style="display: none;">
                <label for="sub_queja">Tipo de Queja:</label>
                <select name="sub_queja" id="sub_queja" class="input-form">
                    <option value="">Seleccione el tipo de queja</option>
                    <option value="Queja al Cliente">Queja al cliente</option>
                    <option value="Queja al Repartidor">Queja al repartidor</option>
                    <option value="Queja al Producto">Queja al producto</option>
                </select>
            </div>

            <!-- Sub-asunto para Recomendaciones -->
            <div id="grupo-recomendacion" style="display: none;">
                <label for="sub_reco">Tipo de Recomendación:</label>
                <select name="sub_reco" id="sub_reco" class="input-form">
                    <option value="">Seleccione el tipo de recomendación</option>
                    <option value="Recomendación al Producto">Al producto</option>
                    <option value="Recomendación al Vendedor">Al vendedor</option>
                    <option value="Recomendación al Servicio">Al servicio</option>
                </select>
            </div>

            <label for="puntuacion">Puntuación:</label>
            <select name="puntuacion" id="puntuacion" class="input-form">
                <option value="">Seleccionar estrellas</option>
                <option value="1 Estrella">1 Estrella ⭐</option>
                <option value="2 Estrellas">2 Estrellas ⭐⭐</option>
                <option value="3 Estrellas">3 Estrellas ⭐⭐⭐</option>
                <option value="4 Estrellas">4 Estrellas ⭐⭐⭐⭐</option>
                <option value="5 Estrellas">5 Estrellas ⭐⭐⭐⭐⭐</option>
            </select>

            <label for="come">Comentario:</label>    
            <textarea name="come" id="come" class="input-form" style="height: 80px;"></textarea>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <input class="boton-enviar" type="reset" value="Borrar" onclick="ocultarSubasuntos()">
                <input class="boton-enviar" type="submit" value="Enviar Comentario">
            </div>
        </form>
    </div>

    <script>
        function mostrarSubasuntos() {
            var asunto = document.getElementById('asu').value;
            var grupoQueja = document.getElementById('grupo-queja');
            var grupoReco = document.getElementById('grupo-recomendacion');

            grupoQueja.style.display = 'none';
            grupoReco.style.display = 'none';

            if (asunto === 'Queja') {
                grupoQueja.style.display = 'block';
            } else if (asunto === 'Recomendaciones') {
                grupoReco.style.display = 'block';
            }
        }

        function ocultarSubasuntos() {
            document.getElementById('grupo-queja').style.display = 'none';
            document.getElementById('grupo-recomendacion').style.display = 'none';
        }
    </script>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'empty') {
            $campo = isset($_GET['campo']) ? $_GET['campo'] : 'requerido';
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Campo incompleto',
                    text: 'Falta completar el campo: $campo',
                    confirmButtonColor: '#344E41'
                });
            </script>";
        } elseif ($_GET['status'] == 'success') {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Enviado!',
                    text: 'Su comentario ha sido guardado exitosamente.',
                    showCancelButton: true,
                    confirmButtonText: 'Ver Comentarios',
                    cancelButtonText: 'Cerrar',
                    confirmButtonColor: '#344E41',
                    cancelButtonColor: '#A3B18A'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'comentarios.php';
                    }
                });
            </script>";
        }
    }
    ?>
</body>
</html>