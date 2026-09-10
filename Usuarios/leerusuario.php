
<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM GestionDeUsuarios";

include '../header.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Vakery's</title>

    <link rel="stylesheet" href="estilosleerusuario.css">
</head>

<div class="usuarios-page">

    <div class="usuarios-contenedor">

        <div class="usuarios-encabezado">

            <div class="usuarios-titulo">
                <h1>Gestión de Usuarios</h1>
                <p>Administra las cuentas y accesos de Vakery’s</p>
            </div>

            <a href="crearusuario.php" class="boton-nuevo-usuario">
                + Nuevo usuario
            </a>

        </div>

        <div class="usuarios-grid">

            <?php

            $resultado = $conn->query($sql);

            if ($resultado && $resultado->num_rows > 0) {

                while ($fila = $resultado->fetch_assoc()) {

                    $CI = $fila['CI'];
                    $nombre = $fila['Nombre'];
                    $estado = strtolower(trim($fila['Estado']));

                    $partes = explode(" ", trim($nombre));

                    if (count($partes) >= 2) {
                        $iniciales = strtoupper(
                            substr($partes[0], 0, 1) .
                            substr($partes[1], 0, 1)
                        );
                    } else {
                        $iniciales = strtoupper(substr($nombre, 0, 2));
                    }

                    if ($estado == "activo") {
                        $claseEstado = "estado-activo";
                    } else {
                        $claseEstado = "estado-bloqueado";
                    }

                    echo "
                    <div class='usuario-card'>

                        <div class='usuario-top'>

                            <div class='usuario-avatar'>
                                $iniciales
                            </div>

                            <div class='usuario-nombre'>
                                <h2>".$fila['Nombre']."</h2>
                                <p>".$fila['Rol']."</p>
                            </div>

                            <span class='usuario-estado $claseEstado'>
                                ".$fila['Estado']."
                            </span>

                        </div>

                        <div class='usuario-info'>

                            <div class='usuario-dato'>
                                <div class='usuario-icono'>CI</div>
                                <div class='usuario-texto'>
                                    <small>Carnet de identidad</small>
                                    <span>".$fila['CI']."</span>
                                </div>
                            </div>

                            <div class='usuario-dato'>
                                <div class='usuario-icono'>TEL</div>
                                <div class='usuario-texto'>
                                    <small>Celular</small>
                                    <span>".$fila['Numero']."</span>
                                </div>
                            </div>

                            <div class='usuario-dato'>
                                <div class='usuario-icono'>DIR</div>
                                <div class='usuario-texto'>
                                    <small>Dirección</small>
                                    <span>".$fila['Direccion']."</span>
                                </div>
                            </div>

                        </div>

                        <div class='usuario-acciones'>

                            <a href='actualizarusuario.php?CI=$CI'>
                                <button type='button' class='usuario-boton usuario-editar'>
                                    Editar
                                </button>
                            </a>

                            <a href='mostrarusuario.php?CI=$CI'>
                                <button type='button' class='usuario-boton usuario-mostrar'>
                                    Mostrar
                                </button>
                            </a>
                    ";

                    if ($estado == "activo") {

                        echo "
                            <a href='bloquear.php?CI=$CI'>
                                <button type='button' class='usuario-boton usuario-bloquear'>
                                    Bloquear usuario
                                </button>
                            </a>
                        ";

                    } else {

                        echo "
                            <a href='desbloquear.php?CI=$CI'>
                                <button type='button' class='usuario-boton usuario-desbloquear'>
                                    Desbloquear usuario
                                </button>
                            </a>
                        ";
                    }

                    echo "
                        </div>

                    </div>
                    ";
                }

            } else {

                echo "
                <div class='sin-usuarios'>
                    No hay usuarios registrados.
                </div>
                ";

            }

            ?>

        </div>

    </div>

</div>