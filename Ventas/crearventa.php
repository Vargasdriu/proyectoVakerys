<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername,$username, $password,$bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pedidos_id =$_POST['pedidos_id'];
    $costoTotal =$_POST['costoTotal'];
    $Estado =$_POST['Estado'];
    $Metodo =$_POST['Metodo'];

    $sql = "INSERT INTO ventas (pedidos_id, costoTotal, Estado, Metodo) 
            VALUES ('$pedidos_id', '$costoTotal', '$Estado', '$Metodo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: mostrarventa.php");
        exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Venta</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background-image:url("../imagenes/fondooo.png");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:30px;
    font-family:'Raleway',sans-serif;
}

.contenedor{
    background:rgba(52,78,65,.95);
    width:500px;
    padding:45px;
    border-radius:35px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    color:white;
}

h2{
    text-align:center;
    margin-bottom:30px;
    font-size:32px;
}

form{
    display:flex;
    flex-direction:column;
}

label{
    margin-bottom:8px;
    font-size:16px;
    color:#DAD7CD;
}

input{
    padding:14px;
    border:none;
    border-radius:15px;
    margin-bottom:20px;
    font-size:16px;
    outline:none;
    background:#F8F7F3;
    color:#344E41;
}

input:focus{
    border:2px solid #A3B18A;
}

.boton{
    background:#A3B18A;
    color:#344E41;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.boton:hover{
    background:white;
    transform:translateY(-4px);
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

.swal2-container {
    z-index: 99999 !important;
}
</style>
</head>

<body>

<?php include_once "../header.php"; ?>

<div class="contenedor">

<form action="resgisventa.php" method="post" id="RegistrarVenta">

    <h2>Registrar Venta</h2>

    <input type="hidden" name="pedidos_id" id="pedidos_id" >

    <label>Costo Total:</label>
    <input type="number" placeholder="COSTO TOTAL" name="costoTotal" id="costoTotal" >

    <label>Estado:</label>
    <input type="text" placeholder="ESTADO"  name="Estado" id="Estado">

    <label>Método de Pago:</label>
    <input type="text" placeholder="METODO DE PAGO" name="Metodo" id="Metodo">

    <input type="submit" value="Registrar Venta" class="boton">

</form>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("ActualizarVenta").addEventListener("submit", function(event) {
    event.preventDefault();

    var b = document.getElementById("costoTotal");
    var c = document.getElementById("Estado");
    var d = document.getElementById("Metodo");

    var ex = /^[0-9]*$/;
    var expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

    function mostrarAlerta(mensaje, elemento) {
        Swal.fire({
            icon: 'error',
            title: '¡Oops!',
            text: mensaje,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Entendido'
        }).then(() => {
            elemento.focus();
        });
    }

    if (b.value.trim() == "") {
        mostrarAlerta("El campo Costo Total no puede ir vacío", b);
        return;
    }
    if (!ex.exec(b.value)) {
        mostrarAlerta("Introduce solo números en el Costo Total", b);
        return;
    }

    if (c.value.trim() == "") {
        mostrarAlerta("El campo Estado no puede ir vacío", c);
        return;
    }
    if (!expRegNombre.exec(c.value)) {
        mostrarAlerta("Introduce solo letras en el Estado", c);
        return;
    }

    if (d.value.trim() == "") {
        mostrarAlerta("El campo Método no puede ir vacío", d);
        return;
    }
    if (!expRegNombre.exec(d.value)) {
        mostrarAlerta("Introduce solo letras en el Método", d);
        return;
    }

    this.submit();
});
</script>

</div>
</body>
</html>