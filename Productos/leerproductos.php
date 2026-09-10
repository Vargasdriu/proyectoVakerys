<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "vakerysss";

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

$conn->set_charset("utf8");

include '../header.php';

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Vakery's</title>

    <link rel="stylesheet" href="estilosleerproductos.css">
</head>

<body>

<main class="catalogo">

    <div class="catalogo-header">

        <div>
            <p class="mini-titulo">VAKERY'S · ADMINISTRACIÓN</p>

            <h1>Productos</h1>

            <p class="descripcion">
                Consulta y administra los productos de tu catálogo.
            </p>
        </div>

        <a href="crearproducto.php" class="btn-nuevo">
            + Agregar producto
        </a>

    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="linea"></div>

    <section class="lista">

        <?php

        if($resultado && $resultado->num_rows > 0){

            while($fila = $resultado->fetch_assoc()){

                $Codigo = $fila["Codigo"];
                $Stock = (int)$fila["Stock"];

                if($Stock <= 0){
                    $estado = "Agotado";
                    $clase = "agotado";
                }elseif($Stock < 5){
                    $estado = "Stock bajo";
                    $clase = "bajo";
                }else{
                    $estado = "Disponible";
                    $clase = "disponible";
                }

                echo "<article class='producto'>";

                echo "<div class='producto-imagen'>";

                if(!empty($fila["Imagen"])){

                    echo "<img src='../imagenes/"
                        .htmlspecialchars($fila["Imagen"])
                        ."' alt='"
                        .htmlspecialchars($fila["NombreProducto"])
                        ."'>";

                }else{

                    echo "<div class='sin-imagen'>
                            Sin imagen
                          </div>";

                }

                echo "</div>";

                echo "<div class='producto-principal'>";

                echo "<div class='producto-cabecera'>";

                echo "<span class='codigo'>"
                    .htmlspecialchars($Codigo)
                    ."</span>";

                echo "<span class='estado ".$clase."'>"
                    .$estado.
                    "</span>";

                echo "</div>";

                echo "<h2>"
                    .htmlspecialchars($fila["NombreProducto"])
                    ."</h2>";

                echo "<p>"
                    .htmlspecialchars($fila["DetalleProducto"])
                    ."</p>";

                echo "</div>";

                echo "<div class='producto-precio'>";

                echo "<span>Precio de venta</span>";

                echo "<strong>
                        Bs "
                        .htmlspecialchars($fila["PrecioProducto"])
                        ."
                      </strong>";

                echo "</div>";

                echo "<div class='producto-stock'>";

                echo "<span>Stock</span>";

                echo "<strong>"
                    .$Stock.
                    "</strong>";

                echo "</div>";

                echo "<div class='acciones'>";

                echo "<a href='mostrarproducto.php?Codigo=".$Codigo."' class='ver'>
                        Ver
                      </a>";

                echo "<a href='actualizarproducto.php?Codigo=".$Codigo."'>
                        Editar
                      </a>";

                echo "<a href='verimagenes.php?codigo=".$Codigo."'>
                        Imágenes
                      </a>";

                echo "<a href='añadirimagen.php?codigo=".$Codigo."'>
                        + Imagen
                      </a>";

                echo "<a href='eliminarproducto.php?Codigo=".$Codigo."' 
        class='eliminar'
        onclick=\"return confirmarEliminacion(event, '".$Codigo."');\">
        Eliminar
      </a>";


                echo "</div>";

                echo "</article>";
            }

        }else{

            echo "<div class='vacio'>
                    <h2>No hay productos registrados</h2>
                    <p>Agrega un producto para comenzar.</p>

                    <a href='crearproducto.php'>
                        Agregar producto
                    </a>
                  </div>";

        }

        ?>

    </section>

</main>

</body>

</html>
<script>
function confirmarEliminacion(event, Codigo) {

    event.preventDefault();

    Swal.fire({
        title: '¿Eliminar producto?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#344E41',
        cancelButtonColor: '#A3B18A',
        reverseButtons: true
    }).then((resultado) => {

        if (resultado.isConfirmed) {
            window.location.href = 'eliminarproducto.php?Codigo=' + encodeURIComponent(Codigo);
        }

    });

    return false;
}
</script>
<?php
$conn->close();
?>
