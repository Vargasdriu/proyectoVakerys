<?php
session_start();
date_default_timezone_set('America/La_Paz');

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$Nombre = trim($_POST['Nombre'] ?? '');
$Fecha = date('Y-m-d');
$Estado = "Pendiente";
$NombreVendedor = trim($_POST['NombreVendedor'] ?? '');
$Direccion = trim($_POST['Direccion'] ?? '');
$Telefono = trim($_POST['Telefono'] ?? '');

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($Nombre === '') {
        $error = "Debe ingresar el nombre del cliente.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO pedidos
            (Nombre, Fecha, Estado, NombreVendedor, Direccion, Telefono)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "ssssss",
                $Nombre,
                $Fecha,
                $Estado,
                $NombreVendedor,
                $Direccion,
                $Telefono
            );

            if ($stmt->execute()) {
                $idPedido = $conn->insert_id;
                $_SESSION["pedido"] = $idPedido;
                header("Location: productos.php?idPedido=" . $idPedido);
                exit;
            } else {
                $error = "No se pudo registrar el pedido: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Error al preparar la consulta: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, rgb(163,177,138), rgb(88,129,87));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Raleway', sans-serif;
            padding: 30px;
        }
        .contenedor {
            background: rgba(52,78,65,.95);
            width: 500px;
            padding: 50px 40px;
            border-radius: 35px;
            text-align: center;
            color: white;
            box-shadow: 0 15px 35px rgba(0,0,0,.2);
            border: 2px solid rgba(255,255,255,.08);
            backdrop-filter: blur(8px);
        }
        h1 {
            font-size: 35px;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
            margin-bottom: 35px;
            opacity: .9;
        }
        .boton {
            display: inline-block;
            background: #88a07a;
            color: white;
            text-decoration: none;
            padding: 16px 35px;
            border-radius: 18px;
            font-size: 18px;
            font-weight: bold;
            transition: .3s;
        }
        .boton:hover {
            background: white;
            color: rgb(52,78,65);
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,.15);
        }
    </style>
</head>
<body>
    <?php include '../header.php'; ?>
    <div class="contenedor">
        <?php if ($error !== null) { ?>
            <h1>✕ Error</h1>
            <p>El pedido no fue creado con éxito.</p>
            <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php } else { ?>
            <h1>Registrar Pedido</h1>
            <p>Complete los datos del pedido para continuar.</p>
        <?php } ?>
        <a class="boton" href="leerpedido.php">Volver a Pedidos</a>
    </div>
</body>
</html>