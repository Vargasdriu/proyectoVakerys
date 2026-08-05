<?php
include '../header.php';

$codigo = "";

if (isset($_GET["codigo"])) {
    $codigo = $_GET["codigo"];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Imágenes</title>

    <link rel="stylesheet" href="estiloscrear.css">
</head>
<body>

<video autoplay muted loop>
    <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
</video>

<div class="capa"></div>

<div class="tra">

<form action="guardarimagenes.php" method="POST" enctype="multipart/form-data" id="AgregarImagenes">

    <h2>Agregar Imágenes</h2>

    <label>Seleccione las imágenes del producto</label>

    <input
        type="text"
        name="CodigoProducto"
        id="CodigoProducto"
        value="<?php echo $codigo; ?>"
        readonly
    >

    <input
        type="file"
        name="Imagenes[]"
        id="Imagenes"
        accept="image/*"
        multiple
    >

    <input class="buttom" type="submit" value="Subir imágenes">

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.getElementById("AgregarImagenes").addEventListener("submit", function(event){

    event.preventDefault();

    var codigo = document.getElementById("CodigoProducto");
    var imagenes = document.getElementById("Imagenes");

    function mostrarAlerta(mensaje, elemento){

        Swal.fire({
            icon: "error",
            title: "¡Oops!",
            text: mensaje,
            confirmButtonColor: "#62a38a",
            confirmButtonText: "Entendido"
        }).then(() => {
            elemento.focus();
        });

    }

    if(codigo.value.trim() == ""){
        mostrarAlerta("No se encontró el código del producto.", codigo);
        return;
    }

    if(imagenes.files.length == 0){
        mostrarAlerta("Seleccione al menos una imagen.", imagenes);
        return;
    }

    this.submit();

});

</script>

</body>
</html>