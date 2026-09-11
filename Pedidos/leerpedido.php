<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM Pedidos";
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos | Vakery's</title>

    <link rel="stylesheet" href="estilosleerpedidos.css">
</head>
<body>
    
<?php include '../header.php'; ?>

<div class="contenedor">

    <div class="encabezado">

        <div class="titulo">
            <h1>Gestión de Pedidos</h1>
            <p>Administra y consulta los pedidos registrados en Vakery’s</p>
        </div>

        <a href="crearpedido.php" class="nuevo">
            + Nuevo Pedido
        </a>

    </div>

    <div class="pedidos">

        <?php

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0){

            while($fila = $resultado->fetch_assoc()){

                $id = $fila['id'];

                echo "
                <div class='pedido'>

                    <div class='pedido-top'>
                        <div class='codigo'>
                            Pedido <span>#".$fila['id']."</span>
                        </div>

                        <div class='estado estado-".$fila['Estado']."'>
                                    ".$fila['Estado']."
                        </div>
                    </div>

                    <div class='info'>

                        <div class='dato'>
                            <span class='etiqueta'>Cliente</span>
                            <span class='valor'>".$fila['Nombre']."</span>
                        </div>

                        <div class='dato'>
                            <span class='etiqueta'>Fecha</span>
                            <span class='valor'>".$fila['Fecha']."</span>
                        </div>

                        <div class='dato'>
                            <span class='etiqueta'>Vendedor</span>
                            <span class='valor'>".$fila['NombreVendedor']."</span>
                        </div>

                        <div class='dato'>
                            <span class='etiqueta'>Teléfono</span>
                            <span class='valor'>".$fila['Telefono']."</span>
                        </div>

                        <div class='dato dato-completo'>
                            <span class='etiqueta'>Dirección</span>
                            <span class='valor'>".$fila['Direccion']."</span>
                        </div>

                    </div>

                    <div class='separador'></div>

                    <div class='acciones'>

                        <a href='actualizarpedido.php?id=$id'>
                            <button class='accion editar'>Editar</button>
                        </a>

                        <a href='../carrito/miCarrito.php?idPedido=$id'>
                            <button class='accion mostrar'>Añadir productos</button>
                        </a>
                        <a href='mostrarproductos.php?id=$id'>
                        <button class='accion mostrar'>Mostrar</button>
                        </a>
                        <a href='mostrardetalle.php?id=$id'>
                            <button class='accion detalle'>Ver Detalle</button>
                        </a>

                        <a href='eliminarpedido.php?id=$id'>
                            <button class='accion eliminar'>Eliminar</button>
                        </a>

                    </div>

                </div>
                ";
            }

        } else {

            echo "<div class='sin-pedidos'>No hay pedidos registrados.</div>";

        }

        ?>

    </div>

</div>
</body>
</html>