<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss"; 

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

session_start();

if(!isset($_GET['idPedido'])){
    die("Error: No se ha especificado un ID de pedido.");
}

$id_pedido = $_GET['idPedido'];

// Ajustado a tu tabla 'productos'
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

// Ajustado a tus columnas 'CostoTotal' y 'pedidos_id'
$sqlTotal = "SELECT sum(CostoTotal) as total FROM carrito WHERE pedidos_id='$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['total'] ?? 0;

echo "<h3>Total del Pedido: $".$total."</h3>";
echo "<table border='1'>";

echo "<tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
        <th>Cantidad</th>
        <th>Agregar al Carrito</th>
      </tr>";

while($fila = $resultado->fetch_assoc()){
    echo "<form action='agregarCarrito.php' method='post'>";
    echo "<tr>";
        // Mapeo con tus columnas en la base de datos
        echo "<td>".$fila["Codigo"]."</td>";
        echo "<td>".$fila["NombreProducto"]."</td>";
        echo "<td>".$fila["DetalleProducto"]."</td>";
        echo "<td>".$fila["PrecioProducto"]."</td>";
        echo "<td>
                <a href='producto.php?codigo=".$fila["Codigo"]."'>Ver</a>
            </td>";
        
        // Inputs ocultos para procesar la inserción
        echo "<input type='hidden' value='".$fila["Codigo"]."' name='codigo'>";
        echo "<input type='hidden' value='".$id_pedido."' name='idpedido'>";
        echo "<input type='hidden' value='".$fila["PrecioProducto"]."' name='precio'>";
        
        echo "<td><input type='number' name='cantidad' value='1' min='1'></td>";
        echo "<td><input type='submit' value='Agregar'></td>";
    echo "</tr>";
    echo "</form>";
}

echo "</table><br>";
echo "<a href='formPedido.php'><button>Generar Nuevo Pedido</button></a>";

$conn->close();
?>