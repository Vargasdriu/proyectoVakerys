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

$CodigoProducto = $_GET["codigo"];

$sql = "SELECT * FROM imagenes WHERE CodigoProducto = '$CodigoProducto'";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Galería de imágenes</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Cormorant+Garamond:wght@500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#DAD7CD;
    padding:35px;
    margin-top:75px;
}

.contenedor{
    max-width:1450px;
    margin:auto;
    background:white;
    border-radius:30px;
    padding:40px;
    box-shadow:0 10px 30px rgba(52,78,65,.15);
}

h1{
    text-align:center;
    font-family:'Cormorant Garamond',serif;
    color:#344E41;
    font-size:52px;
    margin-bottom:8px;
}

.subtitulo{
    text-align:center;
    color:#588157;
    font-size:18px;
    margin-bottom:35px;
}

.barra{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:40px;
}

.agregar{
    background:#344E41;
    color:white;
    text-decoration:none;
    padding:12px 22px;
    border-radius:12px;
    transition:.3s;
    font-weight:500;
}

.agregar:hover{
    background:#3A5A40;
}

.galeria{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(360px,1fr));
    gap:35px;
}

.card{
    background:#F8F7F3;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(52,78,65,.12);
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(52,78,65,.18);
}

.card img{
    width:100%;
    height:350px;
    object-fit:cover;
}

.info{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px;
}

.nombre{
    color:#344E41;
    font-weight:500;
    font-size:15px;
    word-break:break-word;
}

.eliminar{
    color:#C1121F;
    font-size:24px;
    transition:.3s;
    cursor:pointer;
}

.eliminar:hover{
    color:#780000;
    transform:scale(1.2);
}

.sin{
    text-align:center;
    font-size:22px;
    color:#588157;
    padding:60px;
}

.volver{
    display:flex;
    justify-content:center;
    margin-top:45px;
}

.volver button{
    border:none;
    background:#344E41;
    color:white;
    padding:12px 28px;
    border-radius:14px;
    cursor:pointer;
    font-size:15px;
    font-family:'Poppins',sans-serif;
    transition:.3s;
}

.volver button:hover{
    background:#3A5A40;
    transform:scale(1.05);
}

</style>

</head>

<body>

<?php include '../header.php'; ?>

<div class="contenedor">

<h1>Galería de imágenes  </h1>

<p class="subtitulo">
Producto: <strong><?php echo $CodigoProducto; ?></strong>
</p>

<div class="barra">

<div></div>

<a class="agregar" href="añadirimagen.php?codigo=<?php echo $CodigoProducto; ?>">
    <i class="fa-solid fa-plus"></i> Añadir imágenes
</a>

</div>

<div class="galeria">

<?php

if($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

        echo "<div class='card'>";

        echo "<img src='".$fila["Imagen"]."'>";

        echo "<div class='info'>";

        echo "<span class='nombre'>".basename($fila["Imagen"])."</span>";

        echo "<a class='eliminar' href='#' onclick=\"confirmarEliminar(".$fila["idImagen"].",'".$CodigoProducto."')\">
                <i class='fa-solid fa-trash'></i>
              </a>";

        echo "</div>";

        echo "</div>";

    }

}else{

    echo "<div class='sin'>
            <i class='fa-regular fa-image' style='font-size:70px;margin-bottom:15px;'></i><br>
            Este producto aún no tiene imágenes registradas.
          </div>";

}

$conn->close();

?>

</div>

<div class="volver">

<a href="leerproductos.php">
<button>
<i class="fa-solid fa-arrow-left"></i> Volver al panel
</button>
</a>

</div>

</div>

<script>

function confirmarEliminar(id, codigo){

    Swal.fire({
        title: '¿Eliminar imagen?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#C1121F',
        cancelButtonColor: '#344E41',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if(result.isConfirmed){

            window.location.href = "eliminarimagen.php?id=" + id + "&codigo=" + codigo;

        }

    });

}

</script>

</body>
</html>