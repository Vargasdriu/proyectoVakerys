<?php

session_start();

require("conexion.php");

header("Content-Type: application/json; charset=UTF-8");


/* ==========================================
   VERIFICAR PEDIDO ACTIVO
========================================== */

if (!isset($_SESSION["pedido"])) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "No existe pedido activo"
    ]);

    exit;
}


$idPedido = $_SESSION["pedido"];

$accion = $_POST["accion"] ?? "";


/* ==========================================
   ACCIONES
========================================== */

switch ($accion) {


    /* ======================================
       AGREGAR PRODUCTO
    ====================================== */

    case "agregar":

        $codigo =
            $_POST["codigo"] ?? "";


        $cantidadAgregar =
            intval(
                $_POST["cantidad"] ?? 1
            );


        if ($codigo == "") {

            echo json_encode([
                "ok" => false,
                "mensaje" =>
                    "Código de producto inválido"
            ]);

            exit;

        }


        if ($cantidadAgregar < 1) {

            $cantidadAgregar = 1;

        }


        /* ==================================
           BUSCAR PRODUCTO
        ================================== */

        $sqlProducto = "
            SELECT
                Codigo,
                NombreProducto,
                PrecioProducto,
                Stock
            FROM productos
            WHERE Codigo = '$codigo'
        ";


        $resultadoProducto =
            $conn->query($sqlProducto);


        if (
            !$resultadoProducto ||
            $resultadoProducto->num_rows == 0
        ) {

            echo json_encode([
                "ok" => false,
                "mensaje" =>
                    "Producto no encontrado"
            ]);

            exit;

        }


        $producto =
            $resultadoProducto->fetch_assoc();


        $precio =
            intval(
                $producto["PrecioProducto"]
            );


        /* ==================================
           VERIFICAR STOCK
        ================================== */

        $stock =
            intval(
                $producto["Stock"]
            );


        if ($cantidadAgregar > $stock) {

            echo json_encode([
                "ok" => false,
                "mensaje" =>
                    "No hay suficiente stock"
            ]);

            exit;

        }


        /* ==================================
           VERIFICAR SI YA ESTÁ EN CARRITO
        ================================== */

        $sqlExiste = "
            SELECT
                Cantidad
            FROM carrito
            WHERE productos_Codigo = '$codigo'
            AND pedidos_id = '$idPedido'
        ";


        $resultadoExiste =
            $conn->query($sqlExiste);


        if (
            $resultadoExiste &&
            $resultadoExiste->num_rows > 0
        ) {


            /* ==============================
               PRODUCTO YA EXISTE
            ============================== */

            $fila =
                $resultadoExiste->fetch_assoc();


            $cantidadActual =
                intval(
                    $fila["Cantidad"]
                );


            $cantidadNueva =
                $cantidadActual +
                $cantidadAgregar;


            if ($cantidadNueva > $stock) {

                echo json_encode([
                    "ok" => false,
                    "mensaje" =>
                        "No hay suficiente stock"
                ]);

                exit;

            }


            $costoTotal =
                $cantidadNueva *
                $precio;


            $sql = "
                UPDATE carrito

                SET
                    Cantidad = '$cantidadNueva',
                    CostoTotal = '$costoTotal'

                WHERE productos_Codigo = '$codigo'

                AND pedidos_id = '$idPedido'
            ";


        } else {


            /* ==============================
               PRODUCTO NUEVO
            ============================== */

            $costoTotal =
                $cantidadAgregar *
                $precio;


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
                    '$codigo',
                    '$idPedido',
                    '$cantidadAgregar',
                    '$costoTotal'
                )
            ";

        }


        /* ==================================
           EJECUTAR
        ================================== */

        if ($conn->query($sql)) {

            echo json_encode([
                "ok" => true,
                "mensaje" =>
                    "Producto añadido al carrito"
            ]);

        } else {

            echo json_encode([
                "ok" => false,
                "mensaje" =>
                    $conn->error
            ]);

        }

    break;


    /* ======================================
       MOSTRAR CARRITO
    ====================================== */

    case "mostrar":

        $sql = "
            SELECT

                c.productos_Codigo,
                c.pedidos_id,
                c.Cantidad,
                c.CostoTotal,

                p.Codigo,
                p.NombreProducto,
                p.PrecioProducto,
                p.Imagen

            FROM carrito c

            INNER JOIN productos p
                ON c.productos_Codigo = p.Codigo

            WHERE c.pedidos_id = '$idPedido'

            ORDER BY p.NombreProducto
        ";


        $resultado =
            $conn->query($sql);


        $carrito = [];


        if ($resultado) {

            while (
                $fila =
                $resultado->fetch_assoc()
            ) {

                $carrito[] =
                    $fila;

            }

        }


        echo json_encode(
            $carrito
        );

    break;


    /* ======================================
       VACIAR CARRITO
    ====================================== */

    case "vaciar":

        $sql = "
            DELETE FROM carrito

            WHERE pedidos_id =
                '$idPedido'
        ";


        if ($conn->query($sql)) {

            echo json_encode([
                "ok" => true,
                "mensaje" =>
                    "Carrito vaciado correctamente"
            ]);

        } else {

            echo json_encode([
                "ok" => false,
                "mensaje" =>
                    $conn->error
            ]);

        }

    break;


    /* ======================================
       ACCIÓN NO RECONOCIDA
    ====================================== */

    default:

        echo json_encode([
            "ok" => false,
            "mensaje" =>
                "Acción no válida"
        ]);

    break;

}

?>