<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $bdname
);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if (!isset($_SESSION["pedido"])) {
    echo "No existe pedido activo";
    exit;
}

$id = $_SESSION["pedido"];

$sql = "
    SELECT *
    FROM pedidos
    WHERE id = '$id'
";

$resultado = $conn->query($sql);

if (!$resultado || $resultado->num_rows == 0) {
    echo "No se encontró el pedido.";
    exit;
}

$pedido = $resultado->fetch_assoc();

$sqlProductos = "
    SELECT
        p.NombreProducto,
        c.Cantidad,
        c.CostoTotal
    FROM carrito c
    INNER JOIN productos p
        ON c.productos_Codigo = p.Codigo
    WHERE c.pedidos_id = '$id'
";

$resultadoProducto = $conn->query($sqlProductos);

$total = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recibo</title>

    <link rel="stylesheet" href="../estilos/estilosrecibo.css">

</head>

<body>

    <div class="recibo">

        <h1>VAKERY'S</h1>

        <h2>Recibo de pedido</h2>

        <p>
            <strong>Número:</strong>
            <?php echo $pedido["id"]; ?>
        </p>

        <p>
            <strong>Cliente:</strong>
            <?php echo htmlspecialchars($pedido["Nombre"]); ?>
        </p>

        <p>
            <strong>Fecha:</strong>
            <?php echo $pedido["Fecha"]; ?>
        </p>

        <p>
            <strong>Dirección:</strong>
            <?php echo htmlspecialchars($pedido["Direccion"]); ?>
        </p>

        <p>
            <strong>Teléfono:</strong>
            <?php echo $pedido["Telefono"]; ?>
        </p>

        <p>
            <strong>Estado:</strong>
            <?php echo htmlspecialchars($pedido["Estado"]); ?>
        </p>

        <hr>

        <h3>Productos</h3>

        <?php

        if ($resultadoProducto && $resultadoProducto->num_rows > 0) {

            while ($producto = $resultadoProducto->fetch_assoc()) {

                $total += $producto["CostoTotal"];

                ?>

                <div class="producto">

                    <p>
                        <strong>
                            <?php echo htmlspecialchars($producto["NombreProducto"]); ?>
                        </strong>
                    </p>

                    <p>
                        Cantidad:
                        <?php echo $producto["Cantidad"]; ?>
                    </p>

                    <p>
                        Subtotal:
                        Bs <?php echo $producto["CostoTotal"]; ?>
                    </p>

                </div>

                <hr>

                <?php

            }

        } else {

            echo "<p>No hay productos asociados a este pedido.</p>";

        }

        ?>

        <h2>
            Total: Bs <?php echo $total; ?>
        </h2>

        <h3>
            Esperando aprobación del vendedor
        </h3>

        <button onclick="window.print()">
            🖨 Imprimir
        </button>

        <button type="button" id="volverProductos">
            Volver a Productos
        </button>

    </div>

    <script>

        document
            .getElementById("volverProductos")
            .addEventListener("click", function() {

                window.location.href = "productos.php";

            });

    </script>

</body>

</html>