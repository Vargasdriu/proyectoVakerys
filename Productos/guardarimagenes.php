<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$CodigoProducto = $_POST["CodigoProducto"];

$sql = "SELECT Codigo FROM productos WHERE Codigo = '$CodigoProducto'";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    die("El producto no existe.");
}

$carpeta = "imagenes/";

if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

foreach ($_FILES["Imagenes"]["name"] as $i => $nombreArchivo) {

    if ($_FILES["Imagenes"]["error"][$i] == 0) {

        $nombreTemporal = $_FILES["Imagenes"]["tmp_name"][$i];

        $nuevoNombre = basename($nombreArchivo);

        $ruta = $carpeta . $nuevoNombre;

        if (move_uploaded_file($nombreTemporal, $ruta)) {

            $sql = "INSERT INTO imagenes (CodigoProducto, Imagen)
                    VALUES ('$CodigoProducto', '$ruta')";

            $conn->query($sql);
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar imágenes</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>body{
    font-family: 'Poppins', sans-serif;
}

h2{
    font-family: 'Cormorant Garamond', serif;
    font-size: 42px;
    font-weight: 700;
    color: #344E41;
    text-align: center;
    margin-bottom: 20px;
}

label{
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: 500;
    color: #344E41;
}

input,
button{
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
}

input[type="submit"]{
    font-weight: 600;
    letter-spacing: 1px;
}</style>
</head>
<body>

<script>
Swal.fire({
    title: "Éxito",
    text: "Las imágenes se subieron correctamente.",
    icon: "success",
    confirmButtonText: "Aceptar"
}).then(() => {
    window.location = "verimagenes.php?codigo=<?php echo $CodigoProducto; ?>";
});
</script>

</body>
</html>