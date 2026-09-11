<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error){
    die("Conexion fallida: " . $conexion->connect_error);
}

$pedidos_id = $_POST['pedidos_id'];
$costoTotal = $_POST['costoTotal'];
$Estado = $_POST['Estado'];
$Metodo = $_POST['Metodo'];

$sql = "UPDATE ventas SET 
    costoTotal='$costoTotal',
    Estado='$Estado',
    Metodo='$Metodo'
    WHERE pedidos_id='$pedidos_id'";

$resultado = $conexion->query($sql);

$error = $conexion->error;

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Actualizar Venta</title>

<!-- Fuente Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#A3B18A,#588157);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:30px;
}

.contenedor{
    background:white;
    width:500px;
    padding:50px;
    border-radius:35px;
    text-align:center;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

h1{
    font-size:35px;
    margin-bottom:20px;
}

p{
    font-size:18px;
    margin-bottom:30px;
}

.boton{
    display:inline-block;
    background:#A3B18A;
    color:#344E41;
    text-decoration:none;
    padding:14px 30px;
    border-radius:18px;
    font-weight:bold;
    transition:.3s;
}

.boton:hover{
    background:white;
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}
</style>
</head>

<body>

<?php include_once '../header.php'; ?>

<div class="contenedor">

<?php if($resultado): ?>

<script>
Swal.fire({
    title: '¡Venta actualizada!',
    text: 'Los datos fueron actualizados correctamente.',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157',
    background: 'white',
    color: '#344E41',
    customClass: {
        popup: 'poppins-alert',
        title: 'poppins-title',
        htmlContainer: 'poppins-text',
        confirmButton: 'poppins-button'
    }
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = 'leerventa.php';
    }
});
</script>

<?php else: ?>

<script>
Swal.fire({
    title: '¡Ocurrió un error! ❌',
    text: 'No se pudo actualizar la venta.',
    icon: 'error',
    confirmButtonText: 'Volver',
    confirmButtonColor: '#588157',
    background: '#344E41',
    color: '#ffffff',
    customClass: {
        popup: 'poppins-alert',
        title: 'poppins-title',
        htmlContainer: 'poppins-text',
        confirmButton: 'poppins-button'
    }
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = 'leerventa.php';
    }
});
</script>

<?php endif; ?>

</div>

<style>
/* Poppins para SweetAlert */
.poppins-alert,
.poppins-title,
.poppins-text,
.poppins-button{
    font-family:'Poppins',sans-serif !important;
}

.poppins-title{
    font-weight:700 !important;
}

.poppins-text{
    font-weight:400 !important;
}

.poppins-button{
    font-weight:600 !important;
    border-radius:12px !important;
    padding:12px 25px !important;
}
</style>

</body>
</html>
