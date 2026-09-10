<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión");
}

include("header.php");

$fechas = [];
$ventas = [];

$sql = "SELECT p.Fecha, COUNT(*) AS ventas
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE v.Estado = 'Finalizado'
        GROUP BY p.Fecha
        ORDER BY p.Fecha";

$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $fechas[] = $fila["Fecha"];
    $ventas[] = $fila["ventas"];
}


$productos = [];
$cantidades = [];

$sql = "SELECT p.NombreProducto, SUM(c.Cantidad) AS TotalVendido
        FROM ventas v
        INNER JOIN carrito c ON v.pedidos_id = c.pedidos_id
        INNER JOIN productos p ON c.productos_Codigo = p.Codigo
        INNER JOIN pedidos pe ON v.pedidos_id = pe.id
        WHERE MONTH(pe.Fecha) = MONTH(CURDATE())
        AND YEAR(pe.Fecha) = YEAR(CURDATE())
        AND v.Estado = 'Finalizado'
        GROUP BY p.Codigo, p.NombreProducto
        ORDER BY TotalVendido DESC";

$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila["NombreProducto"];
    $cantidades[] = $fila["TotalVendido"];
}


$ingresos = [];

$sql = "SELECT
            (SELECT COALESCE(SUM(v.costoTotal), 0)
             FROM ventas v
             INNER JOIN pedidos p ON v.pedidos_id = p.id
             WHERE p.Fecha = CURDATE()) AS dia,

            (SELECT COALESCE(SUM(v.costoTotal), 0)
             FROM ventas v
             INNER JOIN pedidos p ON v.pedidos_id = p.id
             WHERE YEARWEEK(p.Fecha, 1) = YEARWEEK(CURDATE(), 1)) AS semana,

            (SELECT COALESCE(SUM(v.costoTotal), 0)
             FROM ventas v
             INNER JOIN pedidos p ON v.pedidos_id = p.id
             WHERE YEAR(p.Fecha) = YEAR(CURDATE())
             AND MONTH(p.Fecha) = MONTH(CURDATE())) AS mes,

            (SELECT COALESCE(SUM(v.costoTotal), 0)
             FROM ventas v
             INNER JOIN pedidos p ON v.pedidos_id = p.id
             WHERE YEAR(p.Fecha) = YEAR(CURDATE())) AS anio,

            (SELECT COALESCE(SUM(v.costoTotal), 0)
             FROM ventas v
             ) AS total";

$resultado = $conn->query($sql);

$fila = $resultado->fetch_assoc();

$ingresosDia = $fila["dia"] ?? 0;
$ingresosSemana = $fila["semana"] ?? 0;
$ingresosMes = $fila["mes"] ?? 0;
$ingresosAnio = $fila["anio"] ?? 0;
$ingresosTotales = $fila["total"] ?? 0;

$ingresosGrafico = [
    $ingresosDia,
    $ingresosSemana,
    $ingresosMes,
    $ingresosAnio
];


$productosStock = [];
$stock = [];

$sql = "SELECT NombreProducto, Stock
        FROM productos
        ORDER BY NombreProducto ASC";

$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $productosStock[] = $fila["NombreProducto"];
    $stock[] = $fila["Stock"];
}


$sqlPedidosClientes = "SELECT
                            p.id AS IdPedido,
                            p.Nombre AS NombreCliente,
                            p.Fecha,
                            p.Estado,
                            p.NombreVendedor,
                            p.Direccion,
                            p.Telefono,
                            u.Numero AS NumeroCliente
                       FROM pedidos p
                       LEFT JOIN gestiondeusuarios u
                       ON p.Telefono = u.Numero
                       ORDER BY p.id DESC";

$resultadoPedidosClientes = $conn->query($sqlPedidosClientes);


$sqlCantidadPedidos = "SELECT
                            Nombre AS Cliente,
                            COUNT(*) AS CantidadPedidos
                       FROM pedidos
                       WHERE Nombre IS NOT NULL
                       AND TRIM(Nombre) <> ''
                       GROUP BY Nombre
                       ORDER BY CantidadPedidos DESC";

$resultadoCantidadPedidos = $conn->query($sqlCantidadPedidos);


$clienteFrecuente = "";
$cantidadPedidosFrecuente = 0;

if ($resultadoCantidadPedidos && $resultadoCantidadPedidos->num_rows > 0) {

    $primeraFila = $resultadoCantidadPedidos->fetch_assoc();

    $clienteFrecuente = $primeraFila["Cliente"];
    $cantidadPedidosFrecuente = $primeraFila["CantidadPedidos"];

    $resultadoCantidadPedidos->data_seek(0);
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reportes</title>

<link rel="stylesheet" href="estilos/reportes.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

    .reporte-clientes {
        width: 92%;
        margin: 45px auto;
        padding: 32px;
        background: #F8F7F3;
        border-radius: 28px;
        box-shadow: 0 10px 30px rgba(52, 78, 65, 0.12);
    }

    .reporte-clientes h2 {
        text-align: center;
        color: #344E41;
        font-size: 30px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .subtitulo-reporte {
        text-align: center;
        color: #588157;
        font-size: 17px;
        margin-bottom: 28px;
    }

    .tabla-clientes {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 18px;
        background: white;
        box-shadow: 0 6px 20px rgba(52, 78, 65, 0.10);
    }

    .tabla-clientes th {
        background: #344E41;
        color: #F8F7F3;
        padding: 17px 14px;
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: .5px;
        border: none;
    }

    .tabla-clientes th:first-child {
        border-top-left-radius: 18px;
    }

    .tabla-clientes th:last-child {
        border-top-right-radius: 18px;
    }

    .tabla-clientes td {
        padding: 15px 14px;
        text-align: center;
        color: #344E41;
        font-size: 18px;
        border-bottom: 1px solid #E5E5DE;
        background: #FFFFFF;
        transition: .25s ease;
    }

    .tabla-clientes tr:last-child td {
        border-bottom: none;
    }

    .tabla-clientes tr:hover td {
        background: #EEF1EA;
    }

    .tabla-clientes td:first-child {
        font-weight: 600;
        color: #588157;
    }

    .cliente-encontrado {
        color: #344E41 !important;
        font-weight: 600;
    }

    .tabla-clientes td:nth-child(3) {
        color: #588157;
        font-weight: 500;
    }

    .tabla-clientes td:nth-child(5) {
        font-weight: 500;
    }

    .cliente-no-encontrado {
        color: #A3A3A3 !important;
        font-style: italic;
        font-size: 18px;
    }

    .tabla-clientes tr {
        transition: .25s ease;
    }

    .tabla-clientes tr:hover {
        transform: scale(1.002);
    }

    .fila-cliente-frecuente td {
        font-weight: 700 !important;
        background: #EEF1EA !important;
        color: #344E41 !important;
        border-top: 2px solid #588157;
    }

    .producto-mas-vendido {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 25px;
        margin-top: 25px;
        padding: 20px;
        background: white;
        border-radius: 18px;
    }

    .producto-mas-vendido img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 18px;
    }

    .producto-mas-vendido h3 {
        color: #344E41;
        font-size: 24px;
        margin: 0 0 10px;
    }

    .producto-mas-vendido p {
        color: #588157;
        font-size: 18px;
        margin: 0;
    }

    @media (max-width: 900px) {

        .reporte-clientes {
            width: 96%;
            padding: 20px;
            overflow-x: auto;
        }

        .tabla-clientes {
            min-width: 750px;
        }

    }

</style>

</head>

<body>

<section class="a">

<h1>Panel de reportes Vakery's</h1>

</section>

<section class="reporte-clientes">

<h2>Pedidos registrados y clientes</h2>
<br>

<?php

if ($resultadoPedidosClientes && $resultadoPedidosClientes->num_rows > 0) {

    echo "<table class='tabla-clientes'>";

    echo "
    <tr>
        <th>ID Pedido</th>
        <th>Cliente</th>
        <th>Numero de teléfono</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Vendedor</th>
    </tr>
    ";

    while ($pedido = $resultadoPedidosClientes->fetch_assoc()) {

        echo "<tr>";

        echo "<td>"
            . htmlspecialchars($pedido["IdPedido"])
            . "</td>";

        echo "<td class='cliente-encontrado'>"
            . htmlspecialchars($pedido["NombreCliente"])
            . "</td>";

        if (!empty($pedido["NumeroCliente"])) {

            echo "<td>"
                . htmlspecialchars($pedido["NumeroCliente"])
                . "</td>";

        } else {

            echo "<td class='cliente-no-encontrado'>
                    Cliente no relacionado
                  </td>";

        }

        echo "<td>"
            . htmlspecialchars($pedido["Fecha"])
            . "</td>";

        echo "<td>"
            . htmlspecialchars($pedido["Estado"])
            . "</td>";

        echo "<td>"
            . htmlspecialchars($pedido["NombreVendedor"])
            . "</td>";

        echo "</tr>";

    }

    echo "</table>";

} else {

    echo "<p style='text-align:center;'>
            No existen pedidos registrados.
          </p>";

}

?>

</section>

<br>

<section class="reporte-clientes">

<h2>Cantidad de pedidos por cliente</h2>

<p class="subtitulo-reporte">
    Cantidad de pedidos realizados por cada cliente :
</p>

<br>

<?php

if ($resultadoCantidadPedidos && $resultadoCantidadPedidos->num_rows > 0) {

    echo "<table class='tabla-clientes'>";

    echo "
    <tr>
        <th>Cliente</th>
        <th>Cantidad de pedidos</th>
    </tr>
    ";

    while ($cliente = $resultadoCantidadPedidos->fetch_assoc()) {

        echo "<tr>";

        echo "<td class='cliente-encontrado'>"
            . htmlspecialchars($cliente["Cliente"])
            . "</td>";

        echo "<td>"
            . htmlspecialchars($cliente["CantidadPedidos"])
            . "</td>";

        echo "</tr>";

    }

    if ($clienteFrecuente != "") {

        echo "<tr class='fila-cliente-frecuente'>";

        echo "<td>
                Cliente con la mayor cantidad de pedidos
              </td>";

        echo "<td>"
            . htmlspecialchars($clienteFrecuente)
            . " con la cantidad de: "
            . htmlspecialchars($cantidadPedidosFrecuente)
            . " pedidos"
            . "</td>";

        echo "</tr>";

    }

    echo "</table>";

} else {

    echo "<p style='text-align:center;'>
            No existen pedidos registrados.
          </p>";

}

?>
</section>

<section class="bc">

<section class="b">

    <div class="tit">

        <img src="imagenes/caida-del-mercado.png" alt="">

        <h2>Productos con bajo stock</h2>

    </div>

    <?php

    $sql = "SELECT *
            FROM productos
            WHERE Stock < 5";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {

        echo "<table>";

        echo "<tr>";

        echo "<th>Codigo</th>";

        echo "<th>Producto</th>";

        echo "<th>Stock</th>";

        echo "<th>Acciones</th>";

        echo "</tr>";

        while ($producto = $resultado->fetch_assoc()) {

            echo "<tr>";

            echo "<td>"
                . $producto["Codigo"]
                . "</td>";

            echo "<td>"
                . $producto["NombreProducto"]
                . "</td>";

            echo "<td>"
                . $producto["Stock"]
                . "</td>";

            echo "<td>
                    <a href='Productos/actualizarproducto.php?Codigo="
                . $producto["Codigo"]
                . "'>
                        + Reponer stock
                    </a>
                  </td>";

            echo "</tr>";

        }

        echo "</table>";

    } else {

        echo "No hay productos con bajo stock.";

    }

    ?>

</section>

<section class="c">

    <div class="titc">

        <img src="imagenes/insignia.png" alt="">

        <h2>Producto más vendido del mes</h2>

    </div>

    <?php

    $sql = "SELECT p.NombreProducto, p.Imagen, SUM(c.Cantidad) AS TotalVendido
            FROM ventas v
            INNER JOIN carrito c
                ON v.pedidos_id = c.pedidos_id
            INNER JOIN productos p
                ON c.productos_Codigo = p.Codigo
            INNER JOIN pedidos pe
                ON v.pedidos_id = pe.id
            WHERE MONTH(pe.Fecha) = MONTH(CURDATE())
            AND YEAR(pe.Fecha) = YEAR(CURDATE())
            AND v.Estado = 'Finalizado'
            GROUP BY p.Codigo, p.NombreProducto, p.Imagen
            ORDER BY TotalVendido DESC
            LIMIT 1";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {

        $producto = $resultado->fetch_assoc();

        echo "<div class='producto-mas-vendido'>";

        echo "<img src='Productos/imagenes/"
            . htmlspecialchars($producto["Imagen"])
            . "' alt='"
            . htmlspecialchars($producto["NombreProducto"])
            . "'>";

        echo "<div>";

        echo "<h3>"
            . htmlspecialchars($producto["NombreProducto"])
            . "</h3>";

        echo "<p>Cantidad vendida: "
            . htmlspecialchars($producto["TotalVendido"])
            . "</p>";

        echo "</div>";

        echo "</div>";

    } else {

        echo "No hay ventas registradas este mes.";

    }

    ?>

</section>

</section>

<section class="d">

<h2>Ingresos</h2>

<section class="ingr">

    <span>Ingreso del día</span>

    <strong>
        <?php echo $ingresosDia; ?> Bs
    </strong>

</section>

<section class="ingr">

    <span>Ingreso de la semana</span>

    <strong>
        <?php echo $ingresosSemana; ?> Bs
    </strong>

</section>

<section class="ingr">

    <span>Ingreso del mes</span>

    <strong>
        <?php echo $ingresosMes; ?> Bs
    </strong>

</section>

<section class="ingr">

    <span>Ingreso del año</span>

    <strong>
        <?php echo $ingresosAnio; ?> Bs
    </strong>

</section>

<section class="ingr">

    <span>Ingresos totales</span>

    <strong>
        <?php echo $ingresosTotales; ?> Bs
    </strong>

</section>

</section>

<section class="e">

<section class="graf">

    <h2>Gráfico de productos más vendidos</h2>

    <canvas id="graficoProductos"></canvas>

</section>

<section class="graf">

    <h2>Gráfico de ingresos</h2>

    <canvas id="graficoIngresos"></canvas>

</section>

</section>

<section class="f">

<section class="graf">

    <h2>Gráfico de stock de los productos</h2>

    <canvas id="graficoStock"></canvas>

</section>

</section>

<script>

const fechas = <?php echo json_encode($fechas); ?>;

const ventas = <?php echo json_encode($ventas); ?>;

const productos = <?php echo json_encode($productos); ?>;

const cantidades = <?php echo json_encode($cantidades); ?>;

const ingresos = <?php echo json_encode($ingresosGrafico); ?>;

const productosStock = <?php echo json_encode($productosStock); ?>;

const stock = <?php echo json_encode($stock); ?>


const contextoProductos =
    document.getElementById("graficoProductos");

const contextoIngresos =
    document.getElementById("graficoIngresos");

const contextoStock =
    document.getElementById("graficoStock");


new Chart(contextoProductos, {

    type: "bar",

    data: {

        labels: productos,

        datasets: [{

            label: "Cantidad vendida",

            data: cantidades

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});


const periodos = [

    "Día",

    "Semana",

    "Mes",

    "Año"

];


new Chart(contextoIngresos, {

    type: "bar",

    data: {

        labels: periodos,

        datasets: [{

            label: "Ingresos en Bs",

            data: ingresos

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});


new Chart(contextoStock, {

    type: "bar",

    data: {

        labels: productosStock,

        datasets: [{

            label: "Stock Disponible",

            data: stock

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true,

                title: {

                    display: true,

                    text: "Cantidad de stock"

                }

            },

            x: {

                title: {

                    display: true,

                    text: "Productos"

                }

            }

        }

    }

});

</script>

<?php

$conn->close();

include("footer.php");

?>

</body>

</html>
