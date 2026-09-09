<?php
$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$asu = trim($_POST['asu'] ?? '');
$come = trim($_POST['come'] ?? '');
$puntuacion = trim($_POST['puntuacion'] ?? '');

$subasunto = '';
if ($asu === 'Queja') {
    $subasunto = trim($_POST['sub_queja'] ?? '');
} elseif ($asu === 'Recomendaciones') {
    $subasunto = trim($_POST['sub_reco'] ?? '');
}

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

$archivo = fopen("coment.txt", "a");
fwrite($archivo, "NOMBRE: " . $nom . PHP_EOL);
fwrite($archivo, "EMAIL: " . $email . PHP_EOL);
fwrite($archivo, "ASUNTO: " . $asu . " (" . $subasunto . ")" . PHP_EOL);
fwrite($archivo, "PUNTUACIÓN: " . $puntuacion . PHP_EOL);
fwrite($archivo, "COMENTARIO: " . $come . PHP_EOL);
fwrite($archivo, "-----------------------------------" . PHP_EOL);
fclose($archivo);

header("Location: formulario.php?status=success");
exit();
?>