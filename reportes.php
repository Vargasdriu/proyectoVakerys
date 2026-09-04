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
            SUM(CASE 
                WHEN p.Fecha = CURDATE() 
                THEN v.costoTotal 
                ELSE 0 
            END) AS dia,
            
            SUM(CASE 
                WHEN YEARWEEK(p.Fecha, 1) = YEARWEEK(CURDATE(), 1)
                THEN v.costoTotal 
                ELSE 0 
            END) AS semana,
            
            SUM(CASE 
                WHEN MONTH(p.Fecha) = MONTH(CURDATE())
                AND YEAR(p.Fecha) = YEAR(CURDATE())
                THEN v.costoTotal 
                ELSE 0 
            END) AS mes,
            
            SUM(CASE 
                WHEN YEAR(p.Fecha) = YEAR(CURDATE())
                THEN v.costoTotal 
                ELSE 0 
            END) AS anio,
            
            SUM(v.costoTotal) AS total
        FROM ventas v
        INNER JOIN pedidos p ON v.pedidos_id = p.id
        WHERE v.Estado = 'Finalizado'";

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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="estilos/reportes.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<section class="a">
    <h1>Panel de reportes Vakery's</h1>
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

                echo "<td>" . $producto["Codigo"] . "</td>";
                echo "<td>" . $producto["NombreProducto"] . "</td>";
                echo "<td>" . $producto["Stock"] . "</td>";

                echo "<td>
                        <a href='Productos/actualizarproducto.php?Codigo=" . $producto["Codigo"] . "'>
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

        if ($resultado && $resultado->num_rows > 0) {

            $producto = $resultado->fetch_assoc();

            echo "Producto: " . $producto["NombreProducto"];
            echo " - Cantidad vendida: " . $producto["TotalVendido"];

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
        <strong><?php echo $ingresosDia; ?> Bs</strong>
    </section>

    <section class="ingr">
        <span>Ingreso de la semana</span>
        <strong><?php echo $ingresosSemana; ?> Bs</strong>
    </section>

    <section class="ingr">
        <span>Ingreso del mes</span>
        <strong><?php echo $ingresosMes; ?> Bs</strong>
    </section>

    <section class="ingr">
        <span>Ingreso del año</span>
        <strong><?php echo $ingresosAnio; ?> Bs</strong>
    </section>

    <section class="ingr">
        <span>Ingresos totales</span>
        <strong><?php echo $ingresosTotales; ?> Bs</strong>
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
    <h1>grafico stock de todos los productos</h1>
    
    
</section>
<script>

const fechas = <?php echo json_encode($fechas); ?>;
const ventas = <?php echo json_encode($ventas); ?>;

const productos = <?php echo json_encode($productos); ?>;
const cantidades = <?php echo json_encode($cantidades); ?>;

const ingresos = <?php echo json_encode($ingresosGrafico); ?>;

const contextoVentas = document.getElementById("graficoVentas");

const contextoProductos = document.getElementById("graficoProductos");

const contextoIngresos = document.getElementById("graficoIngresos");


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
include ("footer.php")
?>

</body>
</html>