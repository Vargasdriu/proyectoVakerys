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

$id_pedido = $_GET['idPedido'] ?? 0;

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
<title>Carrito</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    gap:20px;
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

.form-agregar{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
}

a{
    text-decoration:none;
}
</style>

</head>
<body>
 <?php include '../header.php'; ?>

<div class="contenedor">

    <h1>Carrito</h1>
    <p class="subtitulo">Gestión de productos para pedidos</p>

    <h3 class="total">Total: Bs. <?php echo $total; ?></h3>

    <table class="tabla-estilo">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Precio</th>
      
            <th>Agregar al carrito</th>
        </tr>

        <?php while($fila = $resultado->fetch_assoc()){ ?>

        <tr>
            <td><?php echo $fila["Codigo"]; ?></td>
            <td><?php echo $fila["NombreProducto"]; ?></td>
            <td><?php echo $fila["DetalleProducto"]; ?></td>
            <td>
             <?php
            if($fila["Stock"] <= 5){
             echo "<span style='color:#D46A6A; font-weight:bold;'>".$fila["Stock"]."</span>";
            }else{
            echo $fila["Stock"];
            }
            ?>
</td>

            <td>Bs. <?php echo $fila["PrecioProducto"]; ?></td>



            <td>
                <form action="agregarCarrito.php" method="post" class="form-agregar">

                    <input type="hidden" name="codigo" value="<?php echo $fila['Codigo']; ?>">
                    <input type="hidden" name="idpedido" value="<?php echo $id_pedido; ?>">
                    <input type="hidden" name="precio" value="<?php echo $fila['PrecioProducto']; ?>">

                    <input
                        type="number"
                        name="cantidad"
                        value="1"
                        min="1"
                        required
                    >

                    <button type="submit" class="editar">
                        Agregar
                    </button>

                </form>
            </td>
        </tr>

        <?php } ?>
    </table>

    <div class="boton-centro">
        <a href="../Pedidos/crearpedido.php">
            <button class="nuevo">
                Generar Nuevo Pedido
            </button>
        </a>

       <a href="../Pedidos/leerpedido.php">
            <button class="nuevo">
                Ver Todos Los Pedidos
            </button>
        </a>
</div>
<?php
if(isset($_GET["error"]) && $_GET["error"]=="stock"){
?>
<script>
Swal.fire({
    icon: "error",
    title: "Stock insuficiente",
    text: "No hay suficiente stock disponible."
});
</script>
<?php
}

if(isset($_GET["success"])){
?>
<script>
Swal.fire({
    icon: "success",
    title: "Producto(s) agregado(s)",
    text: "Se agregó correctamente al carrito.",
    timer: 1500,
    showConfirmButton: false
});
</script>
<?php
}
?>
</body>
</html>

<?php
$conn->close();
?>