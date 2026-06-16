<?php
$servername  = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

$Codigo = $_GET['Codigo'];

$sql = "SELECT * FROM Productos WHERE Codigo='$Codigo'";

$resultado = $conn->query($sql);

if($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

        $NombreProducto = $fila['NombreProducto'];
        $PrecioProducto = $fila['PrecioProducto'];
        $DetalleProducto = $fila['DetalleProducto'];
        $Stock = $fila['Stock'];
        $CostoProducto = $fila['CostoProducto'];

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Producto</title>

<style>

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
body::before{
    content:"";
    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,.35);

    z-index:-1;
}
form{
    width:450px;

    background:rgba(52,78,65,.96);

    padding:40px 35px;

    border-radius:30px;

    display:flex;
    flex-direction:column;

    gap:14px;

    color:white;

    box-shadow:0 15px 35px rgba(0,0,0,.2);

    border:2px solid rgba(255,255,255,.08);

    backdrop-filter:blur(8px);
    opacity: 70%;
}

h2{
    text-align:center;

    font-size:34px;

    margin-bottom:15px;

    color:white;
}

label{
    font-size:17px;

    font-weight:600;

    opacity:.9;
}

input{
    padding:14px 16px;

    border:none;

    border-radius:14px;

    outline:none;

    font-size:16px;

    background:#f5f5f5;

    transition:.3s;
}

input:focus{
    transform:scale(1.02);

    box-shadow:0 0 0 3px rgba(136,160,122,.45);
}

input[type="submit"]{
    background:#88a07a;

    color:white;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    margin-top:10px;

    transition:.3s;
}

input[type="submit"]:hover{
    background:white;

    color:rgb(52,78,65);

    transform:translateY(-3px);

    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

@media(max-width:600px){

    form{
        width:100%;
        padding:30px 20px;
    }

    h2{
        font-size:28px;
    }

}


</style>

</head>

<body>
<?php include '../header.php'; ?>
  
<form action="registroeditar.php" method="post" onsubmit="return validar()">

    <h2>Actualizar Producto</h2>

    

    <label>Nombre del Producto:</label>
    <input type="text" name="NombreProducto" value="<?=$NombreProducto?>" id="Producto">

    <label>Precio del Producto:</label>
    <input type="number" name="PrecioProducto" value="<?=$PrecioProducto?>" id="Precio" >

    <label>Detalle del Producto:</label>
    <input type="text" name="DetalleProducto" value="<?=$DetalleProducto?>" id="Detalle" >

    <label>Stock:</label>
    <input type="number" name="Stock" value="<?=$Stock?>" id="Stock" >

    <label>Costo del Producto:</label>
    <input type="number" name="CostoProducto" value="<?=$CostoProducto?>" id="Costo">

    <input type="submit" value="Actualizar Producto">

</form>
<script>
    var a=document.getElementById("Producto");
    var b=document.getElementById("Precio");
    var c=document.getElementById("Detalle");
    var d=document.getElementById("Stock");
    var e=document.getElementById("Costo");
    var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    function validar(){

       
         if(a.value==""){
            alert("este campo no puede ir vacio");
            a.focus();
            return false;
        }
         if(b.value==""){
            alert("este campo no puede ir vacio");
            b.focus();
            return false;
        }
        
         if(c.value==""){
            alert("este campo no puede ir vacio");
            c.focus();
            return false;
        }
         if(d.value==""){
            alert("este campo no puede ir vacio");
            d.focus();
            return false;
        }
         if(e.value==""){
            alert("este campo no puede ir vacio");
            e.focus();
            return false;
        }

    }
</script>
</body>
</html>
