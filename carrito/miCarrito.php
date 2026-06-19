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

$id_pedido = $_GET['idPedido'];
$sql = "SELECT * FROM productos";

$resultado = $conn->query($sql);

$sqlTotal = "SELECT sum(CostoTotal) FROM carrito where pedidos_id='$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['sum(CostoTotal)'];
if($res['sum(CostoTotal)'] == null){
    $total = 0;
}

echo "<h3>Total: ".$total."</h3>";
echo "<table border='1'>";

echo "<tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
        <th colspan=2>Agregar al Carrito</th>
      </tr>";

while($fila = $resultado->fetch_assoc()){
    echo "<form action='agregarCarrito.php' method='post'>";
    echo "<tr>";
        echo "<td>".$fila["Codigo"]."</td>";
        echo "<td>".$fila["NombreProducto"]."</td>";
        echo "<td>".$fila["DetalleProducto"]."</td>";
        echo "<td>".$fila["PrecioProducto"]."</td>";
        echo "<td>
                <a href='producto.php?codigo=".$fila["Codigo"]."'>
                    <button type='button'>Mostrar</button>
                </a>
            </td>";
        echo "<input type='hidden' value='".$fila["Codigo"]."' name='codigo'>";
        echo "<input type='hidden' value='".$id_pedido."' name='idpedido'>";
        echo "<input type='hidden' value='".$fila["PrecioProducto"]."' name='precio'>";
        echo "<td><input type='number' name='cantidad' value=0></td>";
        echo "<td><input type='submit' value='Agregar'></td>";
        echo "</tr>";
        echo "</form>";
}

echo "</table>";
echo "<a href='formPedido.php'>
        <button>Generar Nuevo Pedido</button>
      </a><br><br>";

$conn->close();
?>