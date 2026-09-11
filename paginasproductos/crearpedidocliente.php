<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>NUEVO PEDIDO</title>

    <link
        rel="stylesheet"
        href="../Usuarios/estiloscrear.css"
    >
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

    <style>
    .swal2-popup,
    .swal2-title,
    .swal2-html-container,
    .swal2-confirm,
    .swal2-cancel {
        font-family: 'Poppins', sans-serif !important;
    }


        select#Estado {

            width: 100%;
            padding: 14px;

            margin-top: 12px;
            margin-bottom: 18px;

            border: none;
            border-radius: 14px;

            background: rgba(255,255,255,0.12);

            color: white;

            font-family: 'Poppins', sans-serif;

            font-size: 14px;

            outline: none;

            backdrop-filter: blur(4px);

            box-sizing: border-box;

            cursor: pointer;
        }


        select#Estado option {

            background: #344E41;

            color: #DAD7CD;
        }


        select#Estado:focus {

            background: rgba(255,255,255,0.18);
        }

    </style>

</head>


<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php include '../header.php'; ?>


<video autoplay muted loop>

    <source
        src="../imagenes/vdapplepie.mp4"
        type="video/mp4"
    >

</video>


<div class="capa"></div>

<br>
<div class="tra" style="margin-top: 80px;">

    <form
        action="registropedido.php"
        method="post"
        id="crearpedido"
    >

        <h2>Nuevo Pedido</h2>


        <input
            type="hidden"
            placeholder="id"
            name="id"
            id="id"
        >


        <label>Nombre:</label>

        <input
            type="text"
            placeholder="NOMBRE"
            name="Nombre"
            id="Nombre"
        >


        <label>Fecha:</label>

        <input
            type="date"
            placeholder="FECHA"
            name="Fecha"
            id="Fecha"
            value="<?php echo date('Y-m-d'); ?>"
            readonly
        >


     

        <input
            type="hidden"
            name="Estado"
            id="Estado"
            value="Pendiente"
        >


        <label>Dirección:</label>

        <input
            type="text"
            placeholder="DIRECCIÓN"
            name="Direccion"
            id="Direccion"
        >


        <label>Teléfono:</label>

        <input
            type="number"
            placeholder="TELÉFONO"
            name="Telefono"
            id="Telefono"
        >


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<input
    class="button"
    type="submit"
    value="Registrar"
>

<input
    class="button"
    type="button"
    value="Ir atrás"
    onclick="window.location.href='../paginasproductos/productos.php';"
>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.getElementById("crearpedido").addEventListener("submit", function(event) {

    event.preventDefault();

    var a = document.getElementById("Nombre");
    var b = document.getElementById("Fecha");
    var c = document.getElementById("Estado");
    var d = document.getElementById("Direccion");
    var e = document.getElementById("Telefono");

    var ex = /^[0-9]*$/;

    var expRegNombre =
        /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;


    function mostrarAlerta(mensaje, elemento) {

        Swal.fire({

            icon: 'error',

            title: '¡Oops!',

            text: mensaje,

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Entendido'

        }).then(() => {

            elemento.focus();

        });

    }


    if (a.value.trim() == "") {

        mostrarAlerta(
            "El campo Nombre no puede ir vacío",
            a
        );

        return;
    }

    if (!expRegNombre.exec(a.value)) {

        mostrarAlerta(
            "Introduce solo letras en el Nombre",
            a
        );

        return;
    }



    if (b.value.trim() == "") {

        mostrarAlerta(
            "El campo Fecha no puede ir vacío",
            b
        );

        return;
    }



    if (c.value.trim() == "") {

        mostrarAlerta(
            "El campo Estado no puede ir vacío",
            c
        );

        return;
    }

    if (d.value.trim() == "") {

        mostrarAlerta(
            "El campo Dirección no puede ir vacío",
            d
        );

        return;
    }


    if (e.value.trim() == "") {

        mostrarAlerta(
            "El campo Teléfono no puede ir vacío",
            e
        );

        return;
    }

    if (!ex.exec(e.value)) {

        mostrarAlerta(
            "Introduce solo números en el Teléfono",
            e
        );

        return;
    }



    Swal.fire({

        title: "¡LISTO!",

        text: "Ahora puedes pedir y añadir productos a tu carrito. ¡Disfruta de nuestros productos!",

        icon: "success",

        confirmButtonText: "¡Empezar a pedir!",

        confirmButtonColor: "#62a38a",

        background: "#ffffff",

        color: "#304936"

    }).then((result) => {

        if (result.isConfirmed) {

            this.submit();

        }

    });

});

</script>

</div>


</body>

</html>