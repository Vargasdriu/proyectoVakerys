<?php

session_start();

require("conexion.php");

$id = $_GET["id"] ?? "";

if ($id == "") {

    $mensaje = "No se recibió ningún número de pedido.";
    $estado = "";

} else {

    $stmt = $conn->prepare(
        "SELECT Estado FROM pedidos WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $resultado = $stmt->get_result();

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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
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

    <?php if (!empty($_SESSION['textoGrande'])): ?>
        <style>

body.texto-grande .estado-card {
    padding: 55px 45px;
}

body.texto-grande .numero-pedido {
    font-size: 40px !important;
    line-height: 1.35 !important;
}

body.texto-grande .numero-pedido strong {
    font-size: 40px !important;
}

body.texto-grande .estado {
    font-size: 52px !important;
    line-height: 1.3 !important;
}

body.texto-grande .estado-card h1:not(.numero-pedido) {
    font-size: 42px !important;
    line-height: 1.3 !important;
}

body.texto-grande .error {
    font-size: 20px !important;
    line-height: 1.6 !important;
    padding: 18px 22px;
}

body.texto-grande .volver {
    font-size: 20px !important;
    padding: 16px 36px;
    min-height: 52px;
    box-sizing: border-box;
}

@media (max-width: 600px) {

    body.texto-grande .estado-card {
        padding: 45px 25px;
    }

    body.texto-grande .numero-pedido {
        font-size: 34px !important;
    }

    body.texto-grande .numero-pedido strong {
        font-size: 34px !important;
    }

    body.texto-grande .estado {
        font-size: 42px !important;
    }

    body.texto-grande .estado-card h1:not(.numero-pedido) {
        font-size: 36px !important;
    }

    body.texto-grande .error {
        font-size: 18px !important;
    }

    body.texto-grande .volver {
        font-size: 18px !important;
        width: 100%;
    }

}

</style>
    <?php endif; ?>

    <?php if (!empty($_SESSION['altoContraste'])): ?>
        <style>

body.alto-contraste {
    background-color: #000000 !important;
}

body.alto-contraste .consulta-contenido {
    background-color: #000000 !important;
}

body.alto-contraste .estado-card {
    background-color: #000000 !important;
    color: #FFFFFF !important;
    border: 3px solid #FFFFFF !important;
    box-shadow: none !important;
}

body.alto-contraste .numero-pedido,
body.alto-contraste .numero-pedido strong,
body.alto-contraste .estado,
body.alto-contraste .estado-card h1:not(.numero-pedido) {
    color: #FFFFFF !important;
}

body.alto-contraste .volver {
    background-color: #FFFF00 !important;
    color: #000000 !important;
    border: 3px solid #FFFFFF !important;
    box-shadow: none !important;
}

body.alto-contraste .volver:hover {
    background-color: #FFFFFF !important;
    color: #000000 !important;
    transform: none !important;
}

body.alto-contraste .error {
    background-color: #000000 !important;
    color: #FFFFFF !important;
    border: 3px solid #FFFFFF !important;
}

body.alto-contraste .estado-card *:focus,
body.alto-contraste .volver:focus {
    outline: 4px solid #FFFF00 !important;
    outline-offset: 3px !important;
}

</style>
    <?php endif; ?>

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    

</head>

<body class="<?php

    if (!empty($_SESSION['navegacionTeclado'])) {
        echo 'navegacion-teclado ';
    }

    if (!empty($_SESSION['altoContraste'])) {
        echo 'alto-contraste ';
    }

    if (!empty($_SESSION['textoGrande'])) {
        echo 'texto-grande';
    }

?>">

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