<?php

require("conexion.php");

$id = $_GET["id"] ?? "";

if ($id == "") {
    echo "<h2>No se recibió el número de pedido.</h2>";
    exit;
}

$sql = "
    SELECT *
    FROM pedidos
    WHERE id = '$id'
";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Consultar Pedido | Vakery's</title>

    <link
        rel="stylesheet"
        href="../estilos/estilosproductos.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

</head>

<body>

<?php include '../header.php'; ?>


<div class="s">

    <h1>Consulta de pedido</h1>


    <?php if ($resultado->num_rows > 0): ?>

        <?php $pedido = $resultado->fetch_assoc(); ?>


        <h2>
            Pedido #<?php echo htmlspecialchars($pedido["id"]); ?>
        </h2>


        <p>
            <strong>Estado del pedido:</strong>
            <?php echo htmlspecialchars($pedido["estado"]); ?>
        </p>


        <?php if (isset($pedido["fecha"])): ?>

            <p>
                <strong>Fecha:</strong>
                <?php echo htmlspecialchars($pedido["fecha"]); ?>
            </p>

        <?php endif; ?>


    <?php else: ?>

        <h2>Pedido no encontrado</h2>

        <p>
            No encontramos el pedido número
            <?php echo htmlspecialchars($id); ?>.
        </p>

    <?php endif; ?>


    <br>


    <a href="productos.php">
        Volver a productos
    </a>

</div>


<?php include '../footer.php'; ?>


</body>

</html>


<?php

$conn->close();

?>
