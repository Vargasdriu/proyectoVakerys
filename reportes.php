<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

$sql = "SELECT *
        FROM productos
        WHERE Stock < 5";

$resultado = $conn->query($sql);
include ("header.php");
?>

    

<h2>Productos con bajo stock</h2>

<?php
if ($resultado && $resultado->num_rows > 0) {

    while ($producto = $resultado->fetch_assoc()) {
        echo "Producto: " . $producto["NombreProducto"] .
             " - Stock: " . $producto["Stock"] . "<br>";
    }

} else {
    echo "No hay productos con bajo stock.";
}

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

<h2>Producto más vendido del mes</h2>

<?php
if ($productoMasVendido != "") {
    echo "Producto: " . $productoMasVendido .
         " - Cantidad vendida: " . $cantidadMasVendida . "<br>";
} else {
    echo "No hay ventas registradas este mes.";
}

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

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE p.Fecha = CURDATE()
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);
$ingresosDia = $resultado->fetch_assoc()["Ingresos"];

if ($ingresosDia == null) {
    $ingresosDia = 0;
}

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE YEARWEEK(p.Fecha, 1) = YEARWEEK(CURDATE(), 1)
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);
$ingresosSemana = $resultado->fetch_assoc()["Ingresos"];

if ($ingresosSemana == null) {
    $ingresosSemana = 0;
}

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE MONTH(p.Fecha) = MONTH(CURDATE())
        AND YEAR(p.Fecha) = YEAR(CURDATE())
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);
$ingresosMes = $resultado->fetch_assoc()["Ingresos"];

if ($ingresosMes == null) {
    $ingresosMes = 0;
}

$sql = "SELECT SUM(v.costoTotal) AS Ingresos
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE YEAR(p.Fecha) = YEAR(CURDATE())
        AND v.Estado = 'Finalizado'";

$resultado = $conn->query($sql);
$ingresosAnio = $resultado->fetch_assoc()["Ingresos"];

if ($ingresosAnio == null) {
    $ingresosAnio = 0;
}

$sql = "SELECT SUM(costoTotal) AS IngresosTotales
        FROM ventas
        WHERE Estado = 'Finalizado'";

$resultado = $conn->query($sql);
$ingresosTotales = $resultado->fetch_assoc()["IngresosTotales"];

if ($ingresosTotales == null) {
    $ingresosTotales = 0;
}

$ingresosGrafico = [
    $ingresosDia,
    $ingresosSemana,
    $ingresosMes,
    $ingresosAnio
];
?>

<h2>Ingresos</h2>

<?php
echo "Ingresos del día: " . $ingresosDia . " Bs<br>";
echo "Ingresos de la semana: " . $ingresosSemana . " Bs<br>";
echo "Ingresos del mes: " . $ingresosMes . " Bs<br>";
echo "Ingresos del año: " . $ingresosAnio . " Bs<br>";
echo "Ingresos totales: " . $ingresosTotales . " Bs<br>";
?>

<h2>Gráfico de productos más vendidos</h2>

<canvas id="graficoProductos"></canvas>

<h2>Gráfico de ingresos</h2>

<canvas id="graficoIngresos"></canvas>

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