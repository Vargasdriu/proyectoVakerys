<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if($conexion->connect_error){
    die("Conexión fallida: " . $conexion->connect_error);
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: leerpedido.php");
    exit;
}

$id = $_GET['id'] ?? '';

$stmtCarrito = $conexion->prepare(
    "DELETE FROM carrito WHERE pedidos_id = ?"
);

$stmtCarrito->bind_param("i", $id);

$stmtCarrito->execute();


$stmtPedido = $conexion->prepare(
    "DELETE FROM Pedidos WHERE id = ?"
);

$stmtPedido->bind_param("i", $id);

$resultadoBD = $stmtPedido->execute();

if($resultadoBD){
    $resultado = "exito";
}else{
    $resultado = "error";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eliminar Pedido</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<?php include '../header.php'; ?>

<script>
<?php if($resultado === "exito"){ ?>

Swal.fire({
    title: '¡Pedido eliminado!',
    text: 'El pedido fue eliminado correctamente.',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157',
    background: '#f8f9f5',
    color: '#344e41',
    customClass: {
        popup: 'sweet-vakery'
    }
}).then(() => {
    window.location.href = 'leerpedido.php';
});

<?php }else{ ?>

Swal.fire({
    title: 'Error',
    text: 'No se pudo eliminar el pedido.',
    icon: 'error',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#588157',
    background: '#f8f9f5',
    color: '#344e41'
}).then(() => {
    window.location.href = 'leerpedido.php';
});

<?php } ?>
</script>

</body>
</html>