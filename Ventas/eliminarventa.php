<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$pedidos_id = "";
if (isset($_GET['id'])) {
    $pedidos_id = $_GET['id'];
}

if ($pedidos_id != "") {
    $sql = "DELETE FROM ventas WHERE pedidos_id='$pedidos_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: mostrarventa.php");
        exit();
    } else {
        echo "Error al eliminar la venta: " . $conn->error;
    }
} else {
    header("Location: mostrarventa.php");
    exit();
}
?>