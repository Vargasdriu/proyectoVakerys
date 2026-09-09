<?php
// Configurar la zona horaria correcta
date_default_timezone_set('America/La_Paz');

$nom = trim($_POST['nom'] ?? '');
// Limpiar correo de espacios y pasarlo a minúsculas para agruparlo correctamente
$email = strtolower(trim($_POST['email'] ?? ''));
$asu = trim($_POST['asu'] ?? '');
$come = trim($_POST['come'] ?? '');
$puntuacion = trim($_POST['puntuacion'] ?? '');

$subasunto = '';
if ($asu === 'Queja') {
    $subasunto = trim($_POST['sub_queja'] ?? '');
} elseif ($asu === 'Recomendaciones') {
    $subasunto = trim($_POST['sub_reco'] ?? '');
}

// Validaciones de campos vacíos
if (empty($nom)) {
    header("Location: formulario.php?status=empty&campo=Nombre");
    exit();
}
if (empty($email)) {
    header("Location: formulario.php?status=empty&campo=Correo Electrónico");
    exit();
}
if (empty($asu)) {
    header("Location: formulario.php?status=empty&campo=Asunto");
    exit();
}
if (empty($subasunto)) {
    header("Location: formulario.php?status=empty&campo=Tipo de " . $asu);
    exit();
}
if (empty($puntuacion)) {
    header("Location: formulario.php?status=empty&campo=Puntuación");
    exit();
}
if (empty($come)) {
    header("Location: formulario.php?status=empty&campo=Comentario");
    exit();
}

// Formatear Fecha y Hora Actual
$fecha = date("d/m/Y H:i");

// Guardar los datos en coment.txt
$archivo = fopen("coment.txt", "a");
fwrite($archivo, "NOMBRE: " . $nom . "\n");
fwrite($archivo, "EMAIL: " . $email . "\n");
fwrite($archivo, "ASUNTO: " . $asu . " (" . $subasunto . ")\n");
fwrite($archivo, "PUNTUACIÓN: " . $puntuacion . "\n");
fwrite($archivo, "FECHA: " . $fecha . "\n");
fwrite($archivo, "COMENTARIO: " . $come . "\n");
fwrite($archivo, "-----------------------------------\n");
fclose($archivo);

// Redirigir con estado de éxito
header("Location: formulario.php?status=success");
exit();
?>