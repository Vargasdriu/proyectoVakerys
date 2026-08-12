<?php

session_start();

require("conexion.php");

header(
    "Content-Type: application/json; charset=utf-8"
);



if ($conn->connect_error) {

    echo json_encode(array(

        "ok" => false,

        "mensaje" =>
            "Error de conexión: " .
            $conn->connect_error

    ));

    exit;

}


/ desde idPedido enviado por POST

if (
    isset($_POST["idPedido"]) &&
    $_POST["idPedido"] != ""
) {

    $idPedido =
        intval($_POST["idPedido"]);


    $_SESSION["pedido"] =
        $idPedido;

}



elseif (
    isset($_SESSION["pedido"])
) {

    $idPedido =
        intval($_SESSION["pedido"]);

}


else {

    echo json_encode(array(

        "ok" => false,

        "mensaje" =>
            "No existe un pedido activo"

    ));

    exit;

}



$accion =
    isset($_POST["accion"])
    ? $_POST["accion"]
    : "";


if ($accion == "agregar") {


    $codigo =
        isset($_POST["codigo"])
        ? $_POST["codigo"]
        : "";


    $cantidadNueva =
        isset($_POST["cantidad"])
        ? intval($_POST["cantidad"])
        : 1;


    if ($codigo == "") {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "No se recibió el código del producto"

        ));

        exit;

    }


    if ($cantidadNueva < 1) {

        $cantidadNueva = 1;

    }


    $sql = "
        SELECT PrecioProducto, Stock
        FROM productos
        WHERE Codigo = ?
    ";


    $stmt =
        $conn->prepare($sql);


    if (!$stmt) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "Error al preparar producto: " .
                $conn->error

        ));

        exit;

    }


    $stmt->bind_param(
        "s",
        $codigo
    );


    $stmt->execute();

    $stmt->store_result();


    if ($stmt->num_rows == 0) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "Producto no encontrado"

        ));

        $stmt->close();

        exit;

    }


    $stmt->bind_result(
        $precio,
        $stock
    );


    $stmt->fetch();

    $stmt->close();


    $precio =
        intval($precio);

    $stock =
        intval($stock);



    if ($cantidadNueva > $stock) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "No hay suficiente stock"

        ));

        exit;

    }



    $sql = "
        SELECT Cantidad
        FROM carrito
        WHERE productos_Codigo = ?
        AND pedidos_id = ?
    ";


    $stmt =
        $conn->prepare($sql);


    if (!$stmt) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "Error al preparar carrito: " .
                $conn->error

        ));

        exit;

    }


    $stmt->bind_param(
        "si",
        $codigo,
        $idPedido
    );


    $stmt->execute();

    $stmt->store_result();


    if ($stmt->num_rows > 0) {


        $stmt->bind_result(
            $cantidadActual
        );


        $stmt->fetch();

        $stmt->close();


        $cantidadTotal =
            intval($cantidadActual) +
            $cantidadNueva;


        // Comprobar stock total

        if ($cantidadTotal > $stock) {

            echo json_encode(array(

                "ok" => false,

                "mensaje" =>
                    "No hay suficiente stock"

            ));

            exit;

        }


        $costoTotal =
            $cantidadTotal * $precio;


        $sql = "
            UPDATE carrito

            SET
                Cantidad = ?,
                CostoTotal = ?

            WHERE productos_Codigo = ?
            AND pedidos_id = ?
        ";


        $stmt =
            $conn->prepare($sql);


        if (!$stmt) {

            echo json_encode(array(

                "ok" => false,

                "mensaje" =>
                    $conn->error

            ));

            exit;

        }


        $stmt->bind_param(
            "iisi",
            $cantidadTotal,
            $costoTotal,
            $codigo,
            $idPedido
        );


        if ($stmt->execute()) {

            echo json_encode(array(

                "ok" => true,

                "mensaje" =>
                    "Producto actualizado correctamente"

            ));

        } else {

            echo json_encode(array(

                "ok" => false,

                "mensaje" =>
                    $stmt->error

            ));

        }


        $stmt->close();

    }


    // ======================================
    // PRODUCTO NUEVO
    // ======================================

    else {


        $stmt->close();


        $costoTotal =
            $cantidadNueva * $precio;


        $sql = "
            INSERT INTO carrito
            (
                productos_Codigo,
                pedidos_id,
                Cantidad,
                CostoTotal
            )

            VALUES
            (
                ?,
                ?,
                ?,
                ?
            )
        ";


        $stmt =
            $conn->prepare($sql);


        if (!$stmt) {

            echo json_encode(array(

                "ok" => false,

                "mensaje" =>
                    $conn->error

            ));

            exit;

        }


        $stmt->bind_param(
            "siii",
            $codigo,
            $idPedido,
            $cantidadNueva,
            $costoTotal
        );


        if ($stmt->execute()) {

            echo json_encode(array(

                "ok" => true,

                "mensaje" =>
                    "Producto agregado correctamente"

            ));

        } else {

            echo json_encode(array(

                "ok" => false,

                "mensaje" =>
                    $stmt->error

            ));

        }


        $stmt->close();

    }

}


// ==========================================
// MOSTRAR CARRITO
// ==========================================

elseif ($accion == "mostrar") {

    $sql = "
        SELECT

            c.productos_Codigo,

            c.Cantidad,

            c.CostoTotal,

            p.NombreProducto,

            p.PrecioProducto,

            p.Imagen

        FROM carrito c

        INNER JOIN productos p

            ON c.productos_Codigo =
               p.Codigo

        WHERE c.pedidos_id = ?
    ";


    $stmt =
        $conn->prepare($sql);


    if (!$stmt) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                "Error al preparar consulta: " .
                $conn->error

        ));

        exit;

    }


    $stmt->bind_param(
        "i",
        $idPedido
    );


    $stmt->execute();


    $stmt->bind_result(

        $codigoProducto,

        $cantidad,

        $costoTotal,

        $nombreProducto,

        $precioProducto,

        $imagen

    );


    $carrito = array();


    while ($stmt->fetch()) {

        $carrito[] = array(

            "productos_Codigo" =>
                $codigoProducto,

            "Cantidad" =>
                $cantidad,

            "CostoTotal" =>
                $costoTotal,

            "NombreProducto" =>
                $nombreProducto,

            "PrecioProducto" =>
                $precioProducto,

            "Imagen" =>
                $imagen

        );

    }


    echo json_encode(
        $carrito
    );


    $stmt->close();

}


// ==========================================
// VACIAR CARRITO
// ==========================================

elseif ($accion == "vaciar") {


    $sql = "
        DELETE FROM carrito

        WHERE pedidos_id = ?
    ";


    $stmt =
        $conn->prepare($sql);


    if (!$stmt) {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                $conn->error

        ));

        exit;

    }


    $stmt->bind_param(
        "i",
        $idPedido
    );


    if ($stmt->execute()) {

        echo json_encode(array(

            "ok" => true,

            "mensaje" =>
                "Carrito vaciado correctamente"

        ));

    } else {

        echo json_encode(array(

            "ok" => false,

            "mensaje" =>
                $stmt->error

        ));

    }


    $stmt->close();

}


// ==========================================
// ACCIÓN NO RECONOCIDA
// ==========================================

else {

    echo json_encode(array(

        "ok" => false,

        "mensaje" =>
            "Acción no válida"

    ));

}


$conn->close();

?>