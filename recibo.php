<?php
session_start();
require("php/micarrito.php");

if(!isset($_SESSION["pedidos"])){

    echo "No existe pedido activo";

    exit;

}

$id=$_SESSION["pedidos"];
$sql="
SELECT *
FROM pedidos
WHERE id='$id'
";

$resultado=$conn->query($sql);
$pedido=$resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Recibo</title>
    <link rel="stylesheet" href="css/recibo.css">
</head>
<body>
    <h1> VAKERY'S</h1>
    <h2>Recibo de pedido</h2>

    <p>
    Numero:
    <?php echo $pedidos["id"]; ?>
    </p>
    
    <p>
    Cliente:
    <?php echo $pedidos["Nombre"]; ?>
    </p>
    
    
    <p>
    Fecha:
    <?php echo $pedidos["Fecha"]; ?>
    </p>

    
    <p>
    Direccion:
    <?php echo $pedidos["Direccion"]; ?>
    </p>

    
    <p>
    Telefono:
    <?php echo $pedidos["Telefono"]; ?>
    </p>

    
    <p>
    Estado:
    <?php echo $pedidos["Estado"]; ?>
    </p>
    
    <hr>

    <h3>Productos</h3>
    <?php

    $sqlProductos="

    SELECT 
    p.Nombre,
    c.Cantidad,
    c.Costototal

    FROM carrito c
    INNER JOIN producto p
    ON c.productos_Codigo=p.Codigo
    WHERE c.pedidos_id='$id'

    ";

    $resultadoProductos=$conn->query($sqlproductos);
    $total=0;
    while($producto=$resultadoProductos->fetch_assoc()){
    $total += $producto["costototal"];
    echo "

    <p>
    ".$productos["Nombre"]."
    <br>
    Cantidad: ".$productos["Cantidad"]."
    <br>
    Subtotal: Bs ".$productos["Costototal"]."
    </p>
    ";
    }
    ?>

    <h2>Total: Bs <?php echo $Costototal; ?></h2>
    <h3>Esperando aprobación del vendedor</h3>
    <button onclick="window.print()">
        🖨 Imprimir
    </button>

    <button id="volverProductos">Volver a Productos</button>

    <script>

    document.getElementById("volverProductos")
    document.addEventListener("click",()=>{

    fetch("php/paginaproductos.php")
    .then(res=>res.json())
    .then(data=>{

        if(data.ok){
            window.location.href="paginadeinicio.php";
        }
    });
});

</script>
</body>
</html>
