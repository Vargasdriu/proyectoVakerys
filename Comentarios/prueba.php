<?php

$nom = $_POST["nom"];
$asu = $_POST["asu"];
$come = $_POST["come"];

$archivo = fopen("coment.txt", "a");

fwrite($archivo, "NOMBRE: " . $nom . PHP_EOL);
fwrite($archivo, "ASUNTO: " . $asu . PHP_EOL);
fwrite($archivo, "COMENTARIO: " . $come . PHP_EOL);
fwrite($archivo, "------------------------" . PHP_EOL);

fclose($archivo);

header("Location: comentarios.php");
exit();

?>
