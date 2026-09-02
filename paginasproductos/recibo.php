<?php

session_start();

// ==========================================
// CONEXIÓN A LA BASE DE DATOS
// ==========================================

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

// ==========================================
// VERIFICAR PEDIDO
// ==========================================

if (!isset($_SESSION["pedido"])) {
    die("No existe un pedido activo.");
}

$idPedido = $_SESSION["pedido"];

// ==========================================
// BUSCAR PEDIDO
// ==========================================

$sqlPedido = "
    SELECT
        id,
        Nombre,
        Fecha,
        Estado,
        NombreVendedor,
        Direccion,
        Telefono
    FROM pedidos
    WHERE id = ?
";

$stmtPedido = $conn->prepare($sqlPedido);

if (!$stmtPedido) {
    die("Error en la consulta del pedido: " . $conn->error);
}

$stmtPedido->bind_param("i", $idPedido);
$stmtPedido->execute();

$resultadoPedido = $stmtPedido->get_result();

if ($resultadoPedido->num_rows === 0) {
    die("No se encontró el pedido.");
}

$pedido = $resultadoPedido->fetch_assoc();

$stmtPedido->close();

// ==========================================
// BUSCAR PRODUCTOS DEL PEDIDO
// ==========================================

$sqlProductos = "
    SELECT
        c.productos_Codigo,
        c.Cantidad,
        c.CostoTotal,
        p.NombreProducto,
        p.PrecioProducto,
        p.Imagen
    FROM carrito c
    INNER JOIN productos p
        ON c.productos_Codigo = p.Codigo
    WHERE c.pedidos_id = ?
";

$stmtProductos = $conn->prepare($sqlProductos);

if (!$stmtProductos) {
    die("Error en la consulta de productos: " . $conn->error);
}

$stmtProductos->bind_param("i", $idPedido);
$stmtProductos->execute();

$resultadoProductos = $stmtProductos->get_result();

// ==========================================
// TOTAL
// ==========================================

$total = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recibo - Vakery's</title>

    <link rel="stylesheet" href="../estilos/estilosrecibo.css">

</head>

<body>

    <div class="recibo">

        <!-- ==========================================
             ENCABEZADO
        =========================================== -->

        <h1>VAKERY'S</h1>

        <h2>Recibo de pedido</h2>

        <p>
            <strong>Número de pedido:</strong>
            <?php echo htmlspecialchars($pedido["id"]); ?>
        </p>

        <p>
            <strong>Cliente:</strong>
            <?php echo htmlspecialchars($pedido["Nombre"]); ?>
        </p>

        <p>
            <strong>Fecha:</strong>
            <?php echo htmlspecialchars($pedido["Fecha"]); ?>
        </p>

        <p>
            <strong>Dirección:</strong>
            <?php echo htmlspecialchars($pedido["Direccion"]); ?>
        </p>

        <p>
            <strong>Teléfono:</strong>
            <?php echo htmlspecialchars($pedido["Telefono"]); ?>
        </p>

        <p>
            <strong>Estado:</strong>
            <?php echo htmlspecialchars($pedido["Estado"]); ?>
        </p>

        <hr>

        <!-- ==========================================
             PRODUCTOS
        =========================================== -->

        <h3>Productos</h3>

        <?php

        if ($resultadoProductos->num_rows > 0) {

            while ($producto = $resultadoProductos->fetch_assoc()) {

                $subtotal = (int)$producto["CostoTotal"];

                $total += $subtotal;

                ?>

                <div class="producto">

                    <p>
                        <strong>
                            <?php
                            echo htmlspecialchars(
                                $producto["NombreProducto"]
                            );
                            ?>
                        </strong>
                    </p>

                    <p>
                        Código:
                        <?php
                        echo htmlspecialchars(
                            $producto["productos_Codigo"]
                        );
                        ?>
                    </p>

                    <p>
                        Precio:
                        Bs <?php
                        echo htmlspecialchars(
                            $producto["PrecioProducto"]
                        );
                        ?>
                    </p>

                    <p>
                        Cantidad:
                        <?php
                        echo htmlspecialchars(
                            $producto["Cantidad"]
                        );
                        ?>
                    </p>

                    <p>
                        Subtotal:
                        Bs <?php
                        echo htmlspecialchars(
                            $producto["CostoTotal"]
                        );
                        ?>
                    </p>

                </div>

                <hr>

                <?php

            }

        } else {

            ?>

            <p>
                No hay productos asociados a este pedido.
            </p>

            <?php

        }

        ?>

        <!-- ==========================================
             TOTAL
        =========================================== -->

        <h2>
            Total: Bs <?php echo $total; ?>
        </h2>

        <h3>
            Esperando aprobación del vendedor
        </h3>

        <!-- ==========================================
             BOTONES
        =========================================== -->

        <button
            type="button"
            onclick="window.print()"
        >
            🖨 Imprimir
        </button>

       <button
    type="button"
    onclick="window.location.href='nuevoPedido.php'">

            Volver a Productos
        </button>

    </div>

    <script>

        document
    .getElementById("volverProductos")
    .addEventListener("click", function () {

        window.location.href = "productos.php";

    });

    </script>

</body>

</html>

<?php

$stmtProductos->close();
$conn->close();

?>