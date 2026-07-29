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
    if($fila['Rol']=="Vendedor"){

    if($fila['Estado']=="Bloqueado"){

        echo "
        <script>
        alert('Su cuenta esta bloqueada.');
        window.location.href='../login.php';
        </script>
        ";

    }

}

    
    $_SESSION['Nombre'] = $fila['Nombre'];
    $_SESSION['Rol'] = $fila['Rol'];

   $rol = strtolower(trim($fila['Rol']));

if ($rol == 'administrador') {
    header("Location: ../paginaadmin.php");
    exit();
}
elseif ($rol == 'vendedor') {
    header("Location: ../paginavendedor.php");
    exit();
}
else {
    echo "<script>
            alert('Rol no reconocido.');
            window.location.href='../login.php';
          </script>";
}

} else {
    echo "<script>
            alert('Nombre o CI incorrectos');
            window.location.href='../login.php';
          </script>";
}

$conn->close();
?>

