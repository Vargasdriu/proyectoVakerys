<?php
session_start();
$nombre = isset($_SESSION['Nombre']) ?$_SESSION['Nombre'] : "Vendedor";

$conn = new mysqli("localhost", "root", "", "vakerysss");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar pedidos pendientes o activos (excluyendo Aceptado y Cancelado)
$sqlPedidos = "SELECT p.*, 
               GROUP_CONCAT(CONCAT(pr.NombreProducto, ' x', c.Cantidad) SEPARATOR '<br>') AS resumen_productos,
               SUM(c.CostoTotal) AS total_calculado
               FROM pedidos p
               LEFT JOIN carrito c ON p.id = c.pedidos_id
               LEFT JOIN productos pr ON c.productos_Codigo = pr.Codigo
               WHERE p.Estado IS NULL OR p.Estado NOT IN ('Aceptado', 'Cancelado')
               GROUP BY p.id
               ORDER BY p.id DESC";

$resPedidos = $conn->query($sqlPedidos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Vendedor - Vakery's</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #1f2d25;
            padding-top: 20px;
        }

        .saludo {
            padding: 20px 40px;
            background: #afc194;
            color: #1f2d25;
            margin-bottom: 30px;
        }

        .saludo h1 {
            font-size: 26px;
            font-weight: bold;
        }

        .saludo p {
            font-size: 15px;
            margin-top: 4px;
        }

        .contenedor-pedidos {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }

        .titulo-seccion {
            font-size: 22px;
            color: #1f2d25;
            margin-bottom: 20px;
            border-bottom: 2px solid #afc194;
            padding-bottom: 8px;
        }

        .grid-pedidos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .bf {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .bg {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .bc h2 {
            font-size: 18px;
            color: #1f2d25;
        }

        .bc p {
            font-size: 14px;
            color: #555;
            margin-top: 4px;
        }

        .bd {
            text-align: right;
        }

        .bd h3 {
            font-size: 18px;
            color: #1f2d25;
        }

        .bd p {
            font-size: 12px;
            color: #777;
        }

        .be {
            font-size: 14px;
            color: #444;
            line-height: 1.5;
            margin-bottom: 16px;
            min-height: 50px;
        }

        .be strong {
            color: #1f2d25;
        }

        .btn-atender {
            display: block;
            width: 100%;
            text-align: center;
            background: #afc194;
            color: #1f2d25;
            text-decoration: none;
            padding: 10px 0;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .btn-atender:hover {
            background: #1f2d25;
            color: #ffffff;
        }

        .sin-pedidos {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: #ffffff;
            border-radius: 8px;
            color: #666;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="saludo">
    <h1>¡Hola, <?php echo htmlspecialchars($nombre); ?>!</h1>
   
</div>

<div class="contenedor-pedidos">
    <h2 class="titulo-seccion">Pedidos Pendientes por Atender</h2>

    <div class="grid-pedidos">
        <?php if ($resPedidos &&$resPedidos->num_rows > 0) { ?>
            <?php while ($ped =$resPedidos->fetch_assoc()) { ?>
                <div class="bf">
                    <div class="bg">
                        <div class="bc">
                            <h2>Pedido #<?php echo sprintf('%03d', $ped['id']); ?></h2>
                            <p><?php echo htmlspecialchars($ped['Nombre']); ?></p>
                        </div>
                        <div class="bd">
                            <h3>Bs. <?php echo number_format($ped['total_calculado'] ?$ped['total_calculado'] : 0, 2); ?></h3>
                            <p><?php echo $ped['Fecha']; ?></p>
                        </div>
                    </div>

                    <div class="be">
                        <p><strong>Productos:</strong></p>
                        <p><?php echo $ped['resumen_productos'] ?$ped['resumen_productos'] : "Sin productos asociados"; ?></p>
                    </div>

                    <a href="Ventas/regisventa.php?pedido_id=<?php echo $ped['id']; ?>" class="btn-atender">
                        Atender Pedido
                    </a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="sin-pedidos">
                <h3>No hay pedidos pendientes en este momento.</h3>
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>