<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$Nombre = $_POST['Nombre'];
$CI = $_POST['CI'];

$sql = "SELECT * FROM GestionDeUsuarios WHERE Nombre='$Nombre' AND CI='$CI'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $fila = $result->fetch_assoc();

    
    $_SESSION['Nombre'] = $fila['Nombre'];
    $_SESSION['Rol'] = $fila['Rol'];

    if ($fila['Rol'] == 'Administrador') {
        header("Location: ../paginaadmin.php");
        exit();
    }
    elseif ($fila['Rol'] == 'Vendedor') {
        header("Location: ../paginavendedor.php");
        exit();
    }
    else {
        echo "Rol no reconocido.";
    }

} else {
    echo "Nombre o CI incorrectos.";
}

$conn->close();
?>