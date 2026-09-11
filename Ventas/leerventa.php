<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
include "../header.php";
$sql = "SELECT * FROM ventas";
$resultado = $conn->query($sql);

$totalVentas = $resultado ? $resultado->num_rows : 0;

/* Calcular total de todas las ventas */
$totalDinero = 0;

if ($resultado && $resultado->num_rows > 0) {

    while ($filaTotal = $resultado->fetch_assoc()) {
        $totalDinero += (float)$filaTotal['costoTotal'];
    }

    /* Volver a ejecutar la consulta para mostrar las ventas */
    $resultado = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ventas | Vakerysss</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="ventas.css">

</head>


<body>


<?php include_once "../header.php"; ?>


<div class="dashboard">


    <!-- =====================================
         HERO
    ====================================== -->

    <section class="hero">

        <div class="hero-content">

            <div class="hero-small">
                Administración
            </div>

            <h1>
                Gestión de ventas
            </h1>

            <p>
                Administra y consulta todas las operaciones
                registradas en tu sistema de ventas.
            </p>

        </div>


        <div class="hero-number">

            <span>
                Ventas
            </span>

            <strong>
                <?php echo $totalVentas; ?>
            </strong>

        </div>

    </section>



    <!-- =====================================
         ESTADISTICAS
    ====================================== -->

    <section class="stats">


        <div class="stat">

            <div class="stat-info">

                <span>
                    Ventas registradas
                </span>

                <strong>
                    <?php echo $totalVentas; ?>
                </strong>

            </div>

            <div class="stat-icon">
                V
            </div>

        </div>


        <div class="stat">

            <div class="stat-info">

                <span>
                    Total vendido
                </span>

                <strong>
                    Bs. <?php echo number_format($totalDinero, 2); ?>
                </strong>

            </div>

            <div class="stat-icon">
                Bs
            </div>

        </div>


    </section>



    <!-- =====================================
         LISTA
    ====================================== -->

    <section class="ventas-section">


        <div class="section-top">

            <div class="section-title">

                <h2>
                    Historial de ventas
                </h2>

                <p>
                    Todas las operaciones registradas
                </p>

            </div>

        </div>


        <?php if ($resultado && $resultado->num_rows > 0): ?>


            <div class="lista-header">

                <div>
                    #
                </div>

                <div>
                    Pedido
                </div>

                <div>
                    Total
                </div>

                <div>
                    Método
                </div>

                <div style="text-align:right;">
                    Acciones
                </div>

            </div>


            <?php

            $contador = 1;

            while($fila = $resultado->fetch_assoc()):

                $pedidos_id = $fila['pedidos_id'];
                $estado = $fila['Estado'];
                $metodo = $fila['Metodo'];
                $costo = $fila['costoTotal'];

            ?>


                <article class="venta">


                    <!-- NUMERO -->

                    <div class="numero">

                        <?php echo str_pad($contador,2,"0",STR_PAD_LEFT); ?>

                    </div>


                    <!-- PEDIDO -->

                    <div>

                        <div class="label">
                            Pedido
                        </div>

                        <div class="pedido-id">

                            #<?php echo htmlspecialchars($pedidos_id); ?>

                        </div>

                    </div>


                    <!-- TOTAL -->

                    <div>

                        <div class="label">
                            Total
                        </div>

                        <div class="monto">

                            Bs. <?php echo htmlspecialchars($costo); ?>

                        </div>

                    </div>


                    <!-- METODO -->

                    <div>

                        <div class="label">
                            Método de pago
                        </div>

                        <div class="metodo">

                            <?php echo htmlspecialchars($metodo); ?>

                        </div>

                    </div>


                    <!-- ACCIONES -->

                    <div class="acciones">


                        <div class="estado">

                            <?php echo htmlspecialchars($estado); ?>

                        </div>


                        <a href="mostrarventa.php?pedidos_id=<?php echo $pedidos_id; ?>">

                            <button class="accion">
                                Ver
                            </button>

                        </a>


                        <a href="actualizarventa.php?pedidos_id=<?php echo $pedidos_id; ?>">

                            <button class="accion">
                                Editar
                            </button>

                        </a>


                        <a href="eliminarventa.php?pedidos_id=<?php echo $pedidos_id; ?>">

                            <button class="accion eliminar">
                                Eliminar
                            </button>

                        </a>


                    </div>


                </article>


            <?php

                $contador++;

            endwhile;

            ?>


        <?php else: ?>


            <div class="vacio">

                <h3>
                    No hay ventas registradas
                </h3>

                <p>
                    Las ventas nuevas aparecerán aquí.
                </p>

            </div>


        <?php endif; ?>


    </section>


</div>


</body>

</html>


<?php
$conn->close();
?>
