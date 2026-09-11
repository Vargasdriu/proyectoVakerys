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

<style>

/* =========================================
   GENERAL
========================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --verde:#344E41;
    --verde2:#3A5A40;
    --verde3:#588157;
    --verde4:#A3B18A;

    --beige:#DAD7CD;

    --fondo:#F3F1EC;
    --blanco:#FFFFFF;

    --gris:#7D847E;
    --borde:#E1E0DB;
}

body{
    font-family:'Poppins',sans-serif;

    background:var(--fondo);

    color:var(--verde);

    margin-top:75px;

    padding:40px;
}


/* =========================================
   DASHBOARD
========================================= */

.dashboard{
    max-width:1250px;
    margin:auto;
}


/* =========================================
   HERO
========================================= */

.hero{

    background:var(--verde);

    min-height:270px;

    border-radius:30px;

    padding:45px 55px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    position:relative;

    overflow:hidden;

    box-shadow:
        0 20px 45px rgba(52,78,65,.18);
}

.hero::before{

    content:"";

    position:absolute;

    width:430px;
    height:430px;

    border-radius:50%;

    border:1px solid rgba(255,255,255,.07);

    right:-130px;
    top:-230px;
}

.hero::after{

    content:"";

    position:absolute;

    width:280px;
    height:280px;

    border-radius:50%;

    background:rgba(163,177,138,.10);

    right:80px;
    bottom:-210px;
}

.hero-content{

    position:relative;

    z-index:2;
}

.hero-small{

    color:var(--verde4);

    font-size:12px;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:2px;

    margin-bottom:12px;
}

.hero h1{

    color:white;

    font-size:43px;

    font-weight:600;

    line-height:1.1;

    margin-bottom:13px;
}

.hero p{

    color:rgba(255,255,255,.68);

    font-size:14px;

    max-width:520px;

    line-height:1.8;
}


/* =========================================
   NUMERO GRANDE
========================================= */

.hero-number{

    position:relative;

    z-index:2;

    text-align:right;

    min-width:190px;
}

.hero-number span{

    display:block;

    color:rgba(255,255,255,.55);

    font-size:12px;

    text-transform:uppercase;

    letter-spacing:2px;

    margin-bottom:8px;
}

.hero-number strong{

    color:white;

    font-size:75px;

    line-height:1;

    font-weight:600;
}


/* =========================================
   ESTADISTICAS REALES
========================================= */

.stats{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:20px;

    margin-top:22px;
}

.stat{

    background:white;

    border:1px solid var(--borde);

    border-radius:20px;

    padding:25px 30px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    box-shadow:
        0 5px 20px rgba(52,78,65,.04);
}

.stat-info span{

    display:block;

    color:var(--gris);

    font-size:12px;

    margin-bottom:5px;
}

.stat-info strong{

    color:var(--verde);

    font-size:26px;

    font-weight:600;
}

.stat-icon{

    width:50px;
    height:50px;

    border-radius:15px;

    background:#EDF1EA;

    display:flex;

    justify-content:center;

    align-items:center;

    color:var(--verde3);

    font-size:20px;

    font-weight:600;
}


/* =========================================
   SECCION
========================================= */

.ventas-section{

    margin-top:45px;
}

.section-top{

    display:flex;

    justify-content:space-between;

    align-items:flex-end;

    margin-bottom:20px;
}

.section-title h2{

    color:var(--verde);

    font-size:25px;

    font-weight:600;
}

.section-title p{

    color:var(--gris);

    font-size:13px;

    margin-top:3px;
}


/* =========================================
   ENCABEZADOS
========================================= */

.lista-header{

    display:grid;

    grid-template-columns:
        90px
        1.3fr
        1.2fr
        1.2fr
        310px;

    align-items:center;

    padding:0 28px 12px;

    color:#858B86;

    font-size:11px;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:1px;
}


/* =========================================
   VENTA
========================================= */

.venta{

    background:white;

    border:1px solid var(--borde);

    border-radius:20px;

    min-height:115px;

    margin-bottom:13px;

    padding:22px 28px;

    display:grid;

    grid-template-columns:
        90px
        1.3fr
        1.2fr
        1.2fr
        310px;

    align-items:center;

    position:relative;

    overflow:hidden;

    transition:.25s;
}

.venta::before{

    content:"";

    position:absolute;

    left:0;

    top:0;

    bottom:0;

    width:5px;

    background:var(--verde3);

    opacity:.5;

    transition:.25s;
}

.venta:hover{

    transform:translateY(-3px);

    border-color:#C8CEC2;

    box-shadow:
        0 12px 30px rgba(52,78,65,.08);
}

.venta:hover::before{

    opacity:1;
}


/* =========================================
   NUMERO
========================================= */

.numero{

    font-size:30px;

    color:#D4D9D1;

    font-weight:600;

    letter-spacing:-1px;
}


/* =========================================
   PEDIDO
========================================= */

.label{

    color:#929791;

    font-size:10px;

    text-transform:uppercase;

    letter-spacing:1px;

    margin-bottom:5px;
}

.pedido-id{

    color:var(--verde);

    font-size:16px;

    font-weight:600;
}


/* =========================================
   TOTAL
========================================= */

.monto{

    color:var(--verde);

    font-size:21px;

    font-weight:600;
}


/* =========================================
   METODO
========================================= */

.metodo{

    color:#59625B;

    font-size:14px;

    font-weight:500;
}


/* =========================================
   ZONA ACCIONES
========================================= */

.acciones{

    display:flex;

    align-items:center;

    justify-content:flex-end;

    gap:9px;
}


/* ESTADO */

.estado{

    display:flex;

    align-items:center;

    justify-content:center;

    min-width:105px;

    height:40px;

    padding:0 14px;

    border-radius:10px;

    background:#EDF2EA;

    color:var(--verde3);

    font-size:11px;

    font-weight:600;

    white-space:nowrap;
}

.estado::before{

    content:"";

    width:7px;
    height:7px;

    border-radius:50%;

    background:var(--verde3);

    margin-right:8px;
}


/* =========================================
   BOTONES GRANDES
========================================= */

.accion{

    height:42px;

    padding:0 18px;

    border-radius:10px;

    border:1px solid #D7DAD5;

    background:white;

    color:var(--verde);

    font-family:'Poppins',sans-serif;

    font-size:12px;

    font-weight:600;

    cursor:pointer;

    transition:.2s;

    white-space:nowrap;
}

.accion:hover{

    background:var(--verde);

    border-color:var(--verde);

    color:white;

    transform:translateY(-2px);
}


/* ELIMINAR */

.accion.eliminar{

    color:#914D4D;

    border-color:#E2CECE;
}

.accion.eliminar:hover{

    background:#914D4D;

    border-color:#914D4D;

    color:white;
}


/* =========================================
   SIN VENTAS
========================================= */

.vacio{

    background:white;

    border:1px solid var(--borde);

    border-radius:20px;

    padding:80px 30px;

    text-align:center;
}

.vacio h3{

    color:var(--verde);

    font-size:20px;

    font-weight:600;

    margin-bottom:7px;
}

.vacio p{

    color:var(--gris);

    font-size:13px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:1050px){

    body{
        padding:25px;
    }

    .lista-header{
        display:none;
    }

    .venta{

        grid-template-columns:
            70px
            1fr
            1fr;

        gap:20px;

        padding:25px;
    }

    .acciones{

        grid-column:1 / -1;

        justify-content:flex-start;

        padding-top:18px;

        border-top:1px solid #EEEEEA;
    }

}

@media(max-width:700px){

    body{

        padding:15px;

        margin-top:65px;
    }

    .hero{

        padding:35px 28px;

        min-height:250px;
    }

    .hero h1{

        font-size:32px;
    }

    .hero-number{

        display:none;
    }

    .stats{

        grid-template-columns:1fr;
    }

    .venta{

        grid-template-columns:55px 1fr;

        gap:15px;

        padding:22px;
    }

    .numero{

        grid-row:span 1;
    }

    .acciones{

        grid-column:1 / -1;

        flex-wrap:wrap;

        justify-content:flex-start;
    }

    .estado{

        width:100%;

        justify-content:flex-start;

        padding-left:15px;
    }

    .accion{

        flex:1;

        min-width:90px;

        height:45px;
    }

}

</style>

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
