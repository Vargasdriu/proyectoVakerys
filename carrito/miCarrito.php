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

// Validamos que exista el ID del pedido en la URL
if(!isset($_GET['idPedido']) || empty($_GET['idPedido'])){
    die("Error de flujo: No se recibió un ID de pedido válido.");
}

$id_pedido = $_GET['idPedido'];
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

// Consulta del total usando la estructura exacta de tu tabla 'carrito' y 'pedidos_id'
$sqlTotal = "SELECT sum(CostoTotal) FROM carrito where pedidos_id='$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['sum(CostoTotal)'];
if($res['sum(CostoTotal)'] == null){
    $total = 0;
}

echo "<h3>Total acumulado del Pedido N° ".htmlspecialchars($id_pedido).": Bs. ".$total."</h3>";
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
        echo "<td>".htmlspecialchars($fila["Codigo"])."</td>";
        echo "<td>".htmlspecialchars($fila["NombreProducto"])."</td>";
        echo "<td>".htmlspecialchars($fila["DetalleProducto"])."</td>";
        echo "<td>Bs. ".htmlspecialchars($fila["PrecioProducto"])."</td>";
        echo "<td>
                <a href='producto.php?codigo=".$fila["Codigo"]."'>
                    <button type='button'>Mostrar</button>
                </a>
            </td>";
        
        // Atributos ocultos alineados con los nombres del POST
        echo "<input type='hidden' value='".$fila["Codigo"]."' name='codigo'>";
        echo "<input type='hidden' value='".$id_pedido."' name='idpedido'>";
        echo "<input type='hidden' value='".$fila["PrecioProducto"]."' name='precio'>";
        
        // Control de cantidad (mínimo 1, máximo el Stock disponible en tu base de datos)
        echo "<td><input type='number' name='cantidad' value='1' min='1' max='".$fila['Stock']."'></td>";
        echo "<td><input type='submit' value='Agregar'></td>";
    echo "</tr>";
    echo "</form>";
}

echo "</table><br>";

// CORREGIDO: Redirige al formulario oficial 'formPedido.php' en caso de querer iniciar otro pedido
echo "<a href='formPedido.php'>
        <button type='button'>Generar Nuevo Pedido</button>
      </a><br><br>";

$conn->close();
?>