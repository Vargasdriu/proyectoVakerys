<?php
    session_start();
    $vendedor=$_SESSION['Nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Pedido</title>
</head>
<body>

<h2>Generar Pedido</h2>

<form action="nuevo_pedido.php" method="POST">

    Nombre:
    <input type="text" name="nombre" required><br><br>

    Fecha:
    <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

    <input type="hidden" name="estado" value="En Proceso">

    Nombre Vendedor:
    <input type="text" name="nombreVendedor" value="<?php echo $vendedor; ?>" readonly><br><br>

    <input type="submit" value="Nuevo Pedido">

</form>



</body>
</html>