<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="estilos/reportes.css">
</head>

<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

include("header.php");

$sql = "SELECT *
        FROM productos
        WHERE Stock < 5";

$resultado = $conn->query($sql);

?>

<section class="a">

    <h1>Panel de reportes Vakery's</h1>

</section>

<section class="bc">

    <section class="b">

        <h2>Productos con bajo stock</h2>

        <?php

        // Productos con bajo stock

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

                echo "<td>" . $producto["Codigo"] . "</td>";

                echo "<td>" . $producto["NombreProducto"] . "</td>";

                echo "<td>" . $producto["Stock"] . "</td>";

                echo "<td><a href='Productos/actualizarproducto.php?Codigo=" . $producto["Codigo"] . "'>+ Reponer stock</a></td>";

                echo "</tr>";
            }

            echo "</table>";

        } else {

            echo "No hay productos con bajo stock.";

        }

        ?>

    </section>
    
    <?php

    $sql = "SELECT p.NombreProducto, SUM(c.Cantidad) AS TotalVendido
            FROM ventas v
            INNER JOIN carrito c ON v.pedidos_id = c.pedidos_id
            INNER JOIN productos p ON c.productos_Codigo = p.Codigo
            INNER JOIN pedidos pe ON v.pedidos_id = pe.id
            WHERE MONTH(pe.Fecha) = MONTH(CURDATE())
            AND YEAR(pe.Fecha) = YEAR(CURDATE())
            AND v.Estado = 'Finalizado'
            GROUP BY p.Codigo, p.NombreProducto
            ORDER BY TotalVendido DESC
            LIMIT 1";

    $resultado = $conn->query($sql);

    $productoMasVendido = "";
    $cantidadMasVendida = 0;

    if ($resultado && $resultado->num_rows > 0) {

        $producto = $resultado->fetch_assoc();

        $productoMasVendido = $producto["NombreProducto"];

        $cantidadMasVendida = $producto["TotalVendido"];
    }

    ?>

    <section class="c">

        <h2>Producto más vendido del mes</h2>

        <?php

        // Producto más vendido del mes

        if ($productoMasVendido != "") {

            echo "Producto: " . $productoMasVendido .
                 " - Cantidad vendida: " . $cantidadMasVendida . "<br>";

        } else {

            echo "No hay ventas registradas este mes.";

        }

        ?>

    </section>

</section>

<?php

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

$productos = [];
$cantidades = [];

if ($resultado) {

    while ($producto = $resultado->fetch_assoc()) {

        $productos[] = $producto["NombreProducto"];

        $cantidades[] = $producto["TotalVendido"];
    }
}


// Ingresos del día

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE p.Fecha = CURDATE()
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);

$ingresosDia = 0;

if ($resultado) {

    $datos = $resultado->fetch_assoc();

    if ($datos["Ingresos"] != null) {
        $ingresosDia = $datos["Ingresos"];
    }
}


// Ingreso de la semana

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE YEARWEEK(p.Fecha, 1) = YEARWEEK(CURDATE(), 1)
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);

$ingresosSemana = 0;

if ($resultado) {

    $datos = $resultado->fetch_assoc();

    if ($datos["Ingresos"] != null) {
        $ingresosSemana = $datos["Ingresos"];
    }
}


// Ingreso del mes

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE MONTH(p.Fecha) = MONTH(CURDATE())
        AND YEAR(p.Fecha) = YEAR(CURDATE())
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);

$ingresosMes = 0;

if ($resultado) {

    $datos = $resultado->fetch_assoc();

    if ($datos["Ingresos"] != null) {
        $ingresosMes = $datos["Ingresos"];
    }
}


// Ingreso del año

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE YEAR(p.Fecha) = YEAR(CURDATE())
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);

$ingresosAnio = 0;

if ($resultado) {

    $datos = $resultado->fetch_assoc();

    if ($datos["Ingresos"] != null) {
        $ingresosAnio = $datos["Ingresos"];
    }
}


// Ingresos totales

$sql = "SELECT SUM(costoTotal) AS IngresosTotales
        FROM ventas
        WHERE Estado = 'Finalizado'";

$resultado = $conn->query($sql);

$ingresosTotales = 0;

if ($resultado) {

    $datos = $resultado->fetch_assoc();

    if ($datos["IngresosTotales"] != null) {
        $ingresosTotales = $datos["IngresosTotales"];
    }
}


$ingresosGrafico = [
    $ingresosDia,
    $ingresosSemana,
    $ingresosMes,
    $ingresosAnio
];

?>

<section class="d">

    <h2>Ingresos</h2>

    <?php

    echo "Ingresos del día: " . $ingresosDia . " Bs<br>";
    echo "Ingresos de la semana: " . $ingresosSemana . " Bs<br>";
    echo "Ingresos del mes: " . $ingresosMes . " Bs<br>";
    echo "Ingresos del año: " . $ingresosAnio . " Bs<br>";
    echo "Ingresos totales: " . $ingresosTotales . " Bs<br>";

    ?>

</section>

<section class="e">

    <h2>Gráfico de productos más vendidos</h2>

    <canvas id="graficoProductos"></canvas>

</section>

<section class="f">

    <h2>Gráfico de ingresos</h2>

    <canvas id="graficoIngresos"></canvas>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const productos = <?php echo json_encode($productos); ?>;

const cantidades = <?php echo json_encode($cantidades); ?>;

const contextoProductos = document.getElementById("graficoProductos");

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

const ingresos = <?php echo json_encode($ingresosGrafico); ?>;

const contextoIngresos = document.getElementById("graficoIngresos");

new Chart(contextoIngresos, {

    type: "line",

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

</script>

<?php

$conn->close();

?>

</body>

</html>