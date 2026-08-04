<?php
session_start();

// Control de Permisos: Solo el Administrador puede ingresar
if ($_SESSION['rol'] != 'Administrador') {
    die("Acceso denegado. Solo el Administrador puede modificar ventas.");
}

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

// Si se envió el formulario con los nuevos datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nuevoCliente = $_POST['cliente'];
    $nuevaFecha = $_POST['fecha'];

    $sqlActualizar = "UPDATE pedidos SET Nombre = '$nuevoCliente', Fecha = '$nuevaFecha' WHERE id = '$id'";
    
    if ($conn->query($sqlActualizar)) {
        echo "Venta modificada con éxito. <a href='historial_ventas.php'>Volver</a>";
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// Cargar los datos actuales de la venta a editar
$id_venta = $_GET['id'];
$sql = "SELECT * FROM pedidos WHERE id = '$id_venta'";
$res = $conn->query($sql);
$venta = $res->fetch_assoc();
?>

<h2>Editar Venta #<?php echo $venta['id']; ?> (Admin)</h2>

<form action="editar_venta.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $venta['id']; ?>">

    <label>Cliente:</label><br>
    <input type="text" name="cliente" value="<?php echo $venta['Nombre']; ?>"><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" value="<?php echo $venta['Fecha']; ?>"><br><br>

    <button type="submit">Guardar Cambios</button>
</form>

<?php $conn->close(); ?>