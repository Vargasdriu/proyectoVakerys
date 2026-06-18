<?php
    session_start();
    $vendedor=$_SESSION['Nombre'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Pedido</title>
</head>
<body>
    <?php include '../header.php'; ?>

<h2>Generar Pedido</h2>

<form action="nuevo_pedido.php" method="POST">

    <label for="">Nombre:</label>:
    <input type="text" placeholder=""name="Nombre"><br><br>

    <label for="">Fecha:</label>
    <input type="date" placeholder="" name="Fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

    <label for="">Estado:</label>
    <input type="hidden" name="Estado" value="En Proceso">

    <label for="">Nombre Vendedor</label>
    <input type="text" placeholder="Nombre Vendedor" name="nombreVendedor" value="<?php echo $vendedor?>" readonly><br><br>

    <input type="submit" value="Nuevo Pedido">

</form>

</body>
</html>