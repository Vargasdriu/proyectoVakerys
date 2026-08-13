<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername,$username, $password,$bdname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$Nombre =$_POST['Nombre'];
$CI =$_POST['CI'];

$sql = "SELECT * FROM GestionDeUsuarios WHERE Nombre='$Nombre' AND CI='$CI'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $fila =$result->fetch_assoc();

    // Si está bloqueado, lo manda a la pantalla de bloqueo
    if ($fila['Estado'] == "bloqueado") {

        header("Location: usuariobloqueado.php");
        exit();

    } else {

        $_SESSION['Nombre'] =$fila['Nombre'];
        $_SESSION['Rol'] =$fila['Rol'];

        if ($fila['Rol'] == "administrador") {
            header("Location: ../paginaadmin.php");
            exit();
        } elseif ($fila['Rol'] == "vendedor") {
            header("Location: ../paginavendedor.php");
            exit();
        } else {
            echo "
            <script>
                alert('Rol no reconocido.');
                window.location.href='login.php';
            </script>
            ";
            exit();
        }

    }

} else {

    echo "
    <script>
        alert('Nombre o CI incorrectos');
        window.location.href='login.php';
    </script>
    ";
    exit();

}

$conn->close();
?>