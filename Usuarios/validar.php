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


if($result->num_rows > 0){

    $fila = $result->fetch_assoc();


    if($fila['Estado']=="bloqueado"){

        echo "
        <script>
        document.write('Su cuenta esta bloqueada.');
        window.location.href='../login.php';
        </script>
        ";

    }else{


        $_SESSION['Nombre'] = $fila['Nombre'];
        $_SESSION['Rol'] = $fila['Rol'];


        if($fila['Rol']=="administrador"){

            header("Location: ../paginaadmin.php");

        }elseif($fila['Rol']=="vendedor"){

            header("Location: ../paginavendedor.php");

        }else{

            echo "
            <script>
            alert('Rol no reconocido.');
            window.location.href='../login.php';
            </script>
            ";

        }

    }


}else{

    echo "
    <script>
    alert('Nombre o CI incorrectos');
    window.location.href='../login.php';
    </script>
    ";

}


$conn->close();

?>