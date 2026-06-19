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

$sqlTotal = "SELECT SUM(CostoTotal) AS total FROM carrito WHERE pedidos_id='$id_pedido'";
$resultadoTotal = $conn->query($sqlTotal);
$res = $resultadoTotal->fetch_assoc();
$total = $res['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Productos</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#DAD7CD;
    padding:35px;
    margin-top:75px;
}

.contenedor{
    background:white;
    padding:35px;
    border-radius:30px;
    box-shadow:0px 10px 25px rgba(52,78,65,0.15);
}

h1{
    text-align:center;
    color:#344E41;
    font-size:38px;
    margin-bottom:5px;
}

.subtitulo{
    text-align:center;
    color:#588157;
    margin-bottom:30px;
    font-size:15px;
}

.total{
    text-align:center;
    color:#344E41;
    margin-bottom:20px;
}

.tabla-estilo{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:18px;
}

.tabla-estilo th{
    background:#3A5A40;
    color:white;
    padding:15px;
    font-size:15px;
    letter-spacing:1px;
}

.tabla-estilo td{
    padding:14px;
    text-align:center;
    background:#F8F7F3;
    border-bottom:1px solid #DAD7CD;
    color:#344E41;
}

.tabla-estilo tr:hover td{
    background:#E8E5DC;
    transition:0.3s;
}

button{
    border:none;
    padding:9px 15px;
    border-radius:12px;
    font-family:'Poppins',sans-serif;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
    margin:2px;
}

.editar{
    background:#A3B18A;
    color:#344E41;
}

.editar:hover{
    background:#8E9F73;
    transform:scale(1.05);
}

.mostrar{
    background:#DAD7CD;
    color:#344E41;
    border:1px solid #A3B18A;
}

.mostrar:hover{
    background:#A3B18A;
    transform:scale(1.05);
}

.nuevo{
    margin-top:25px;
    background:#344E41;
    color:white;
    font-size:16px;
    padding:12px 22px;
}

.nuevo:hover{
    background:#3A5A40;
    transform:scale(1.05);
}

.boton-centro{
    display:flex;
    justify-content:center;
    margin-top:20px;
}

input[type="number"]{
    width:70px;
    padding:8px;
    border:1px solid #A3B18A;
    border-radius:10px;
    text-align:center;
    font-family:'Poppins',sans-serif;
    background:white;
    color:#344E41;
}

a{
    text-decoration:none;
}
</style>

</head>
<body>

<div class="contenedor">

    <h1>Productos</h1>
    <p class="subtitulo">Gestión de productos para pedidos</p>

    <h3 class="total">Total: Bs. <?php echo $total; ?></h3>

    <table class="tabla-estilo">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
            <th>Cantidad</th>
            <th>Agregar</th>
        </tr>

        <?php while($fila = $resultado->fetch_assoc()){ ?>
        <form action="agregarCarrito.php" method="post">
            <tr>
                <td><?php echo $fila["Codigo"]; ?></td>
                <td><?php echo $fila["NombreProducto"]; ?></td>
                <td><?php echo $fila["DetalleProducto"]; ?></td>
                <td>Bs. <?php echo $fila["PrecioProducto"]; ?></td>

                <td>
                    <a href="producto.php?codigo=<?php echo $fila['Codigo']; ?>">
                        <button type="button" class="mostrar">Mostrar</button>
                    </a>
                </td>

                <input type="hidden" name="codigo" value="<?php echo $fila['Codigo']; ?>">
                <input type="hidden" name="idpedido" value="<?php echo $id_pedido; ?>">
                <input type="hidden" name="precio" value="<?php echo $fila['PrecioProducto']; ?>">

                <td>
                    <input type="number" name="cantidad" value="0" min="0">
                </td>

                <td>
                    <button type="submit" class="editar">Agregar</button>
                </td>
            </tr>
        </form>
        <?php } ?>
    </table>

    <div class="boton-centro">
        <a href="formPedido.php">
            <button class="nuevo">Generar Nuevo Pedido</button>
        </a>
    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>