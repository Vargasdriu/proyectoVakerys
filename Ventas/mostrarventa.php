<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM ventas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Ventas</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background-image:url("../imagenes/fondooo.png");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
    display:flex;
    flex-direction:column;
    align-items:center;
    min-height:100vh;
    padding:30px;
    font-family:'Raleway',sans-serif;
}

.contenedor-tabla{
    background:rgba(52,78,65,.95);
    width:80%;
    max-width:900px;
    padding:35px;
    border-radius:25px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    color:white;
    margin-top:20px;
}

h2{
    text-align:center;
    margin-bottom:20px;
    font-size:32px;
}

.btn-crear{
    display:inline-block;
    background:#A3B18A;
    color:#344E41;
    padding:10px 20px;
    border-radius:12px;
    text-decoration:none;
    font-weight:bold;
    margin-bottom:20px;
    transition:.3s;
}

.btn-crear:hover{
    background:white;
}

table{
    width:100%;
    border-collapse:collapse;
    text-align:center;
}

th, td{
    padding:12px;
    border-bottom:1px solid #A3B18A;
}

th{
    color:#DAD7CD;
    font-size:18px;
}

a.accion{
    color:#A3B18A;
    text-decoration:none;
    font-weight:bold;
    margin:0 5px;
}

a.accion:hover{
    color:white;
}

a.eliminar{
    color:#ff6b6b;
}
</style>
</head>

<body>

<?php include_once "../header.php"; ?>

<div class="contenedor-tabla">
    <h2>Historial de Ventas</h2>
    <a href="resgisventa.php" class="btn-crear">+ Nueva Venta</a>

    <table>
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Costo Total</th>
                <th>Estado</th>
                <th>Método</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($resultado && $resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $fila['pedidos_id']; ?></td>
                    <td><?php echo $fila['costoTotal']; ?></td>
                    <td><?php echo $fila['Estado']; ?></td>
                    <td><?php echo $fila['Metodo']; ?></td>
                    <td>
                        <a href="actualizarventa.php?id=<?php echo $fila['pedidos_id']; ?>" class="accion">Editar</a> | 
                        <a href="eliminarventa.php?id=<?php echo $fila['pedidos_id']; ?>" class="accion eliminar" onclick="return confirm('¿Deseas eliminar esta venta?')">Eliminar</a>
                    </td>
                </tr>
            <?php 
                }
            } else {
            ?>
                <tr>
                    <td colspan="5">No hay ventas registradas</td>
                </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>