<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conexion = new mysqli($servername, $username, $password, $bdname);

if ($conexion->connect_error){
    die("Conexion fallida: " . $conexion->connect_error);
}

$usuario = null;

if(isset($_GET['CI'])){

$CI = $_GET['CI'] ?? '';

$stmt = $conexion->prepare(
    "SELECT * FROM GestionDeUsuarios WHERE CI = ?"
);

$stmt->bind_param("s", $CI);

$stmt->execute();

$resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        $usuario = $resultado->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mostrar Usuario</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:linear-gradient(135deg,#A3B18A,#588157);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:'Poppins',sans-serif;
    padding:30px;
}

.contenedor{
    background:rgba(52,78,65,.95);
    width:550px;
    padding:45px;
    border-radius:35px;
    color:white;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

h1{
    text-align:center;
    margin-bottom:35px;
    font-size:35px;
}

.dato{
    background:rgba(255,255,255,.08);
    padding:15px 20px;
    border-radius:15px;
    margin-bottom:15px;
    font-size:18px;
}

.dato span{
    font-weight:bold;
    color:#DAD7CD;
}

.boton-centro{
    display:flex;
    justify-content:center;
    margin-top:30px;
}

.boton{
    display:inline-block;
    background:#A3B18A;
    color:#344E41;
    text-decoration:none;
    padding:14px 30px;
    border-radius:18px;
    font-size:17px;
    font-weight:bold;
    transition:.3s;
}

.boton:hover{
    background:white;
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

.error{
    text-align:center;
    font-size:20px;
    color:#ffb3b3;
}

</style>

</head>

<body>
<?php include '../header.php'; ?>
<div class="contenedor">

<?php

if($usuario){

echo "<div class='dato'><span>CI:</span> " . htmlspecialchars($usuario['CI'], ENT_QUOTES, 'UTF-8') . "</div>";

echo "<div class='dato'><span>Nombre:</span> " . htmlspecialchars($usuario['Nombre'], ENT_QUOTES, 'UTF-8') . "</div>";

echo "<div class='dato'><span>Dirección:</span> " . htmlspecialchars($usuario['Direccion'], ENT_QUOTES, 'UTF-8') . "</div>";

echo "<div class='dato'><span>Celular:</span> " . htmlspecialchars($usuario['Numero'], ENT_QUOTES, 'UTF-8') . "</div>";

echo "<div class='dato'><span>Rol:</span> " . htmlspecialchars($usuario['Rol'], ENT_QUOTES, 'UTF-8') . "</div>";

echo "<div class='dato'><span>Estado:</span> " . htmlspecialchars($usuario['Estado'], ENT_QUOTES, 'UTF-8') . "</div>";

}else{

    echo "<h1 class='error'>Usuario no encontrado</h1>";
}

$conexion->close();

?>

<div class="boton-centro">
    <a class="boton" href="leerusuario.php">Volver</a>
</div>

</div>

</body>
</html>