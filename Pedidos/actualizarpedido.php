<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$id = $_GET['id'] ?? '';

$Nombre = "";
$Fecha = "";
$Estado = "";
$NombreVendedor = "";

if ($id != "") {

    $sql = "SELECT * FROM Pedidos WHERE id='$id'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $id = $fila['id'];
            $Nombre = $fila['Nombre'];
            $Fecha = $fila['Fecha'];
            $Estado = $fila['Estado'];
            $NombreVendedor = $fila['NombreVendedor'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Pedido</title>

<link rel="stylesheet" href="../Usuarios/estilosupdate.css">

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

<form action="registroeditar.php" method="post" id="ActualizarPedido">

    <h2>Actualizar Pedido</h2>

    <input type="number" name="id" id="id" value="<?=$id?>">

    <label>Nombre(s):</label>
    <input type="text" name="Nombre" id="Nombre" value="<?=$Nombre?>">

    <label>Fecha:</label>
    <input type="date" name="Fecha" id="Fecha" value="<?=$Fecha?>">

    <label>Estado:</label>
    <input type="text" name="Estado" id="Estado" value="<?=$Estado?>">

    <label>Nombre del Vendedor:</label>
    <input type="text" name="NombreVendedor" id="NombreVendedor" value="<?=$NombreVendedor?>">
   
    <input type="submit" value="Actualizar Usuario" class="boton">

</form>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.getElementById("ActualizarPedido").addEventListener("submit", function(event) {
        
        event.preventDefault();
    
        var b = document.getElementById("Nombre");
        var c = document.getElementById("Fecha");
        var d = document.getElementById("Estado");
        var e = document.getElementById("NombreVendedor");

        
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
            mostrarAlerta("El campo Nombre no puede ir vacío", b);
            return;
        }
        if (!expRegNombre.exec(b.value)) {
            mostrarAlerta("Introduce solo letras en el Nombre", b);
            return;
        }

        
        if (c.value.trim() == "") {
            mostrarAlerta("El campo Fecha no puede ir vacío", c);
            return;
        }

        
        if (d.value.trim() == "") {
            mostrarAlerta("El campo estado no puede ir vacío", d);
            return;
        }
             if (!expRegNombre.exec(d.value)) {
            mostrarAlerta("Introduce solo letras en el Estado", d);
            return;
        }
    
        if (e.value.trim() == "") {
            mostrarAlerta("El campo Nombre del Vendedor no puede ir vacío", e);
            return;
        }
       
        this.submit();
    });
</script>

</div>
</body>
</html>
