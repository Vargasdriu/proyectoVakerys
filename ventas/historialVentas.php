<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "vakerysss";

$conn = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Simulamos los datos de sesión (Rol y Nombre)
$rol = $_SESSION['rol']; // Puede ser 'Administrador' o 'Vendedor'
$nombreUsuario = $_SESSION['Nombre'];

// Filtro SQL según el rol
if ($rol == 'Administrador') {
    // El administrador ve TODAS las ventas
    $sql = "SELECT p.id, p.Nombre AS Cliente, p.Fecha, p.NombreVendedor, SUM(c.CostoTotal) AS Total
            FROM pedidos p
            INNER JOIN carrito c ON p.id = c.pedidos_id
            WHERE p.Estado = 'Finalizado'
            GROUP BY p.id
            ORDER BY p.Fecha DESC";
} else {
    // El vendedor solo ve SUS ventas
    $sql = "SELECT p.id, p.Nombre AS Cliente, p.Fecha, p.NombreVendedor, SUM(c.CostoTotal) AS Total
            FROM pedidos p
            INNER JOIN carrito c ON p.id = c.pedidos_id
            WHERE p.Estado = 'Finalizado' AND p.NombreVendedor = '$nombreUsuario'
            GROUP BY p.id
            ORDER BY p.Fecha DESC";
}

$resultado = $conn->query($sql);
?>

<h2>Historial de Ventas</h2>

<table border="1">
    <tr>
        <th>ID Venta</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Total</th>
        <?php if ($rol == 'Administrador') { echo "<th>Acciones (Solo Admin)</th>"; } ?>
    </tr>

    <?php
    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>#" . $row['id'] . "</td>";
            echo "<td>" . $row['Fecha'] . "</td>";
            echo "<td>" . $row['Cliente'] . "</td>";
            echo "<td>" . $row['NombreVendedor'] . "</td>";
            echo "<td>Bs. " . $row['Total'] . "</td>";

            // Solo mostrar botones de Modificar y Eliminar si es Administrador
            if ($rol == 'Administrador') {
                echo "<td>
                        <a href='editar_venta.php?id=" . $row['id'] . "'>Editar</a> | 
                        <a href='eliminar_venta.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Eliminar esta venta?');\">Eliminar</a>
                      </td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay ventas registradas.</td></tr>";
    }
    ?>
</table>

<?php $conn->close(); ?>