<?php
    session_start();
    $vendedor = $_SESSION['Nombre'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Pedido</title>
</head>
<body>

<h2>Generar Pedido</h2>

<form action="nuevo_Pedido.php" method="POST">

    Nombre:
    <input type="text" name="Nombre" required><br><br>

    Fecha:
    <input type="date" name="Fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

    <input type="hidden" name="Estado" value="En Proceso">

    Nombre Vendedor:
    <input type="text" name="NombreVendedor" value="<?php echo $vendedor; ?>" readonly><br><br>
    <input type="submit" value="Nuevo Pedido">

</form>             

</body>
</html>