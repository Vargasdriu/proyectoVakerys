<?php
require_once __DIR__ . "/../restricciones/administradoryvendedor.php";

$conexion = new mysqli("localhost", "root", "", "vakerysss");
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos.");
}

if (
    !isset($_GET['id']) ||
    !ctype_digit((string) $_GET['id']) ||
    (int) $_GET['id'] <= 0
) {
    header("Location: leerpedido.php");
    exit;
}

$id = (int) $_GET['id'];

$resultado = "error";
$mensaje = "No se pudo eliminar el pedido.";
$icono = "error";

try {
    $conexion->begin_transaction();

    // Consultar el estado del pedido.
    $stmt = $conexion->prepare(
        "SELECT estado FROM pedidos WHERE id = ? FOR UPDATE"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $pedido = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$pedido) {
        throw new Exception("El pedido no existe.");
    }

    $estado = strtolower(trim($pedido['estado']));

    // Los pedidos aceptados nunca se eliminan.
    if ($estado === "aceptado") {
        $conexion->rollback();

        $resultado = "rechazado";
        $mensaje = "Sorry, no se puede borrar un pedido aceptado.";
        $icono = "warning";

    } elseif (
        $estado === "pendiente" ||
        $estado === "rechazado"
    ) {

        // Eliminar las ventas relacionadas con este pedido.
        $stmtVentas = $conexion->prepare(
            "DELETE FROM ventas WHERE pedidos_id = ?"
        );

        $stmtVentas->bind_param("i", $id);
        $stmtVentas->execute();
        $stmtVentas->close();

        // Eliminar los registros relacionados del carrito.
        $stmtCarrito = $conexion->prepare(
            "DELETE FROM carrito WHERE pedidos_id = ?"
        );

        $stmtCarrito->bind_param("i", $id);
        $stmtCarrito->execute();
        $stmtCarrito->close();

        // Eliminar el pedido.
        $stmtPedido = $conexion->prepare(
            "DELETE FROM pedidos WHERE id = ?"
        );

        $stmtPedido->bind_param("i", $id);
        $stmtPedido->execute();

        if ($stmtPedido->affected_rows > 0) {
            $conexion->commit();

            $resultado = "exito";
            $mensaje = "El pedido fue eliminado correctamente.";
            $icono = "success";
        } else {
            throw new Exception("No se pudo eliminar el pedido.");
        }

        $stmtPedido->close();

    } else {
        $conexion->rollback();

        $resultado = "rechazado";
        $mensaje = "Solo se pueden eliminar pedidos pendientes o rechazados.";
        $icono = "warning";
    }

} catch (Throwable $e) {
    try {
        $conexion->rollback();
    } catch (Throwable $ignored) {
        // La transacción ya podría estar cerrada.
    }

    error_log("Error al eliminar pedido: " . $e->getMessage());

    $resultado = "error";
    $mensaje = "Ocurrió un error al eliminar el pedido.";
    $icono = "error";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar pedido</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include '../header.php'; ?>

<script>
Swal.fire({
    title: <?php
        echo json_encode(
            $resultado === "exito"
                ? "¡Pedido eliminado!"
                : ($resultado === "rechazado"
                    ? "No se puede eliminar"
                    : "Error")
        );
    ?>,
    text: <?php echo json_encode($mensaje); ?>,
    icon: <?php echo json_encode($icono); ?>,
    confirmButtonText: "Aceptar",
    confirmButtonColor: "#588157",
    background: "#f8f9f5",
    color: "#344e41"
}).then(() => {
    window.location.href = "leerpedido.php";
});
</script>

</body>
</html>