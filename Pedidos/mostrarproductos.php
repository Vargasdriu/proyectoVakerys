<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$id_pedido = $_GET['id'] ?? 0;

$sqlPedido = "SELECT * FROM pedidos WHERE id = '$id_pedido'";
$resultadoPedido = $conn->query($sqlPedido);

if ($resultadoPedido->num_rows == 0) {
    die("Pedido no encontrado.");
}

$pedido = $resultadoPedido->fetch_assoc();

$sqlProductos = "SELECT 
                    p.Codigo,
                    p.NombreProducto,
                    p.DetalleProducto,
                    p.PrecioProducto,
                    p.Imagen,
                    c.Cantidad,
                    c.CostoTotal
                FROM carrito c
                INNER JOIN productos p 
                    ON c.productos_Codigo = p.Codigo
                WHERE c.pedidos_id = '$id_pedido'";

$resultadoProductos = $conn->query($sqlProductos);

$sqlTotal = "SELECT SUM(CostoTotal) AS total 
             FROM carrito 
             WHERE pedidos_id = '$id_pedido'";

$resultadoTotal = $conn->query($sqlTotal);
$filaTotal = $resultadoTotal->fetch_assoc();
$total = $filaTotal['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido #<?php echo $id_pedido; ?> | Vakery's</title>

    <link rel="stylesheet" href="estilosmostrarpedido.css">
</head>

<body>

<?php include '../header.php'; ?>

<div class="contenedor">

    <div class="encabezado">

        <div class="titulo">
            <h1>Pedido #<?php echo $pedido['id']; ?></h1>
            <p>Productos incluidos en este pedido</p>
        </div>

        <a href="leerpedido.php" class="volver">
            Volver a pedidos
        </a>

    </div>

    <div class="datos-pedido">

        <div class="dato">
            <span class="etiqueta">Cliente</span>
            <span class="valor"><?php echo htmlspecialchars($pedido['Nombre']); ?></span>
        </div>

        <div class="dato">
            <span class="etiqueta">Fecha</span>
            <span class="valor"><?php echo htmlspecialchars($pedido['Fecha']); ?></span>
        </div>

        <div class="dato">
            <span class="etiqueta">Vendedor</span>
            <span class="valor"><?php echo htmlspecialchars($pedido['NombreVendedor']); ?></span>
        </div>

        <div class="dato">
            <span class="etiqueta">Estado</span>
            <span class="valor estado"><?php echo htmlspecialchars($pedido['Estado']); ?></span>
        </div>

    </div>

    <div class="productos">

        <?php if ($resultadoProductos->num_rows > 0) { ?>

            <?php while ($fila = $resultadoProductos->fetch_assoc()) { ?>

                <div class="producto">

                    <div class="imagen">

                        <?php if (!empty($fila['Imagen'])) { ?>

                            <img src="../Productos/imagenes/<?php echo htmlspecialchars($fila['Imagen']); ?>" alt="Producto">

                        <?php } else { ?>

                            <div class="sin-imagen">
                                Sin imagen
                            </div>

                        <?php } ?>

                    </div>

                    <div class="informacion">

                        <span class="codigo">
                            <?php echo htmlspecialchars($fila['Codigo']); ?>
                        </span>

                        <h2>
                            <?php echo htmlspecialchars($fila['NombreProducto']); ?>
                        </h2>

                        <p class="descripcion">
                            <?php echo htmlspecialchars($fila['DetalleProducto']); ?>
                        </p>

                    </div>

                    <div class="cantidad">

                        <span class="etiqueta">
                            Cantidad
                        </span>

                        <strong>
                            <?php echo $fila['Cantidad']; ?>
                        </strong>

                    </div>

                    <div class="precio">

                        <span class="etiqueta">
                            Precio
                        </span>

                        <strong>
                            Bs. <?php echo number_format($fila['PrecioProducto'], 2); ?>
                        </strong>

                    </div>

                    <div class="subtotal">

                        <span class="etiqueta">
                            Subtotal
                        </span>

                        <strong>
                            Bs. <?php echo number_format($fila['CostoTotal'], 2); ?>
                        </strong>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="sin-productos">
                Este pedido todavía no tiene productos agregados.
            </div>

        <?php } ?>

    </div>

    <div class="total">

        <span>Total del pedido</span>

        <strong>
            Bs. <?php echo number_format($total, 2); ?>
        </strong>

    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>