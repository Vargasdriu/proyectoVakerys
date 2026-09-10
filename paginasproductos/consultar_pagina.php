<?php

require("conexion.php");

$id = $_GET["id"] ?? "";

if ($id == "") {

    $mensaje = "No se recibió ningún número de pedido.";
    $estado = "";

} else {

    $sql = "SELECT Estado FROM pedidos WHERE id = '$id'";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {

        $pedido = $resultado->fetch_assoc();

        $estado = $pedido["Estado"];

        $mensaje = "";

    } else {

        $estado = "";

        $mensaje = "No existe un pedido con el número " .
                   htmlspecialchars($id) . ".";

    }

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Consultar pedido | Vakery's</title>


    <link
        rel="stylesheet"
        href="../estilos/estilosproductos.css"
    >


    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        html,
        body {

            margin: 0;

            padding: 0;

            min-height: 100%;

        }


        body {

            min-height: 100vh;

            display: flex;

            flex-direction: column;

            background-color: #f8f5f0;

        }



        .consulta-contenido {

            flex: 1;

            min-height: 65vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 50px 20px;

            box-sizing: border-box;

        }



        .estado-card {

            width: 100%;

            max-width: 500px;

            padding: 50px 40px;

            box-sizing: border-box;

            background-color: #ffffff;

            border-radius: 20px;

            text-align: center;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.10);

        }


   
        .numero-pedido {

            margin: 0 0 35px;

            color: #304936;

            font-family: 'Cormorant Garamond', serif;

            font-size: 32px;

            font-weight: 600;

            text-align: center;

        }


        .numero-pedido strong {

            color: #304936;

            font-weight: 700;

        }


    
        .estado {

            margin: 0 auto 35px;

            color: #304936;

            font-family: 'Cormorant Garamond', serif;

            font-size: 42px;

            font-weight: 700;

            text-align: center;

        }


   

        .volver {

            display: inline-block;

            padding: 13px 32px;

            background-color: #aebf91;

            color: #ffffff;

            text-decoration: none;

            border-radius: 25px;

            font-size: 16px;

            font-weight: 500;

            transition: all 0.3s ease;

            box-shadow:
                0 4px 10px rgba(0, 0, 0, 0.08);

        }


        .volver:hover {

            background-color: #91a874;

            transform: translateY(-2px);

        }



        .estado-card h1:not(.numero-pedido) {

            margin: 0 0 25px;

            color: #304936;

            font-family: 'Cormorant Garamond', serif;

            font-size: 34px;

            font-weight: 700;

        }


        .error {

            margin: 0 0 30px;

            padding: 15px 20px;

            border-radius: 10px;

            background-color: #f8dddd;

            color: #9b4d4d;

            font-size: 16px;

        }


 

        @media (max-width: 600px) {

            .consulta-contenido {

                min-height: 60vh;

                padding: 30px 15px;

            }


            .estado-card {

                padding: 40px 20px;

            }


            .numero-pedido {

                font-size: 27px;

            }


            .estado {

                font-size: 34px;

            }

        }

    </style>

</head>


<body>


<?php include '../header.php'; ?>




<main class="consulta-contenido">


    <div class="estado-card">


        <?php if ($estado != ""): ?>


            <h1 class="numero-pedido">

                Número de pedido:

                <strong>
                    #<?php echo htmlspecialchars($id); ?>
                </strong>

            </h1>


            <div class="estado">

                <?php echo htmlspecialchars($estado); ?>

            </div>


        <?php else: ?>


            <h1>
                Pedido no encontrado
            </h1>


            <p class="error">

                <?php echo $mensaje; ?>

            </p>


        <?php endif; ?>


        <a
            href="productos.php"
            class="volver"
        >
            Volver a productos
        </a>


    </div>


</main>


<?php include '../footer.php'; ?>


</body>

</html>


<?php

$conn->close();

?>