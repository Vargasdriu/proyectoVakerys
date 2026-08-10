<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:'Poppins',sans-serif;
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:35px;
        overflow:hidden;
        margin:0;
    }

    /* Video de fondo */
    video{
        position:fixed;
        top:50%;
        left:50%;
        width:100%;
        height:100%;
        object-fit:cover;
        transform:translate(-50%,-50%);
        z-index:-2;
    }

    /* Capa oscura de superposición */
    .capa{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(52,78,65,0.25);
        z-index:-1;
    }

    /* Contenedor principal */
    .tra{
        position:relative;
        width:100%;
        max-width:500px;
        z-index:10;
    }

    /* Formulario estilo cristal/transparente */
    form{
        background:rgba(52,78,65,0.82);
        padding:40px;
        border-radius:30px;
        box-shadow:0px 10px 25px rgba(0,0,0,0.25);
        border:1px solid rgba(255,255,255,0.15);
        backdrop-filter:blur(10px);
        display:flex;
        flex-direction:column;
    }

    /* Título */
    h2{
        text-align:center;
        color:#DAD7CD;
        margin-bottom:25px;
        font-size:32px;
    }

    /* Labels */
    label{
        color:#DAD7CD;
        font-size:14px;
        margin-bottom:4px;
    }

    /* Inputs */
    input{
        width:100%;
        padding:14px;
        margin-top:6px;
        margin-bottom:18px;
        border:none;
        border-radius:14px;
        background:rgba(255,255,255,0.12);
        color:white;
        font-family:'Poppins',sans-serif;
        font-size:14px;
        outline:none;
        backdrop-filter:blur(4px);
        box-sizing:border-box;
    }

    /* Placeholders */
    input::placeholder{
        color:rgba(255,255,255,0.7);
    }

    /* Focus en Inputs */
    input:focus{
        background:rgba(255,255,255,0.18);
        border:1px solid #A3B18A;
    }

    /* Botón */
    .button{
        margin-top:10px;
        background:#A3B18A;
        color:#344E41;
        font-weight:600;
        cursor:pointer;
        transition:0.3s;
    }

    /* Hover del Botón */
    .button:hover{
        background:#DAD7CD;
        transform:scale(1.03);
    }

    .swal2-container {
        z-index: 99999 !important;
    }
    </style>
</head>
<body>

    <?php include_once '../header.php'; ?>

    <video autoplay muted loop>
        <source src="../imagenes/vdapplepie.mp4" type="video/mp4">
    </video>

    <div class="capa"></div>

    <div class="tra">
        <form action="regisventa.php" method="post" id="CrearVenta">

            <h2>Registrar Venta</h2>

            <label>ID Pedido</label>
            <input type="number" placeholder="ID DEL PEDIDO" name="pedidos_id" id="pedidos_id">

            <label>Costo Total</label>
            <input type="number" placeholder="COSTO TOTAL" name="costoTotal" id="costoTotal">

            <label>Estado</label>
            <input type="text" placeholder="ESTADO" name="Estado" id="Estado">

            <label>Método de Pago</label>
            <input type="text" placeholder="MÉTODO DE PAGO" name="Metodo" id="Metodo">

            <input class="button" type="submit" value="Registrar Venta">

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("CrearVenta").addEventListener("submit", function(event) {
            event.preventDefault();

            var a = document.getElementById("pedidos_id");
            var b = document.getElementById("costoTotal");
            var c = document.getElementById("Estado");
            var d = document.getElementById("Metodo");

            var exNum = /^[0-9]+$/;
            var expRegTexto = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

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
                mostrarAlerta("El campo ID Pedido no puede ir vacío", a);
                return;
            }
            if (!exNum.test(a.value)) {
                mostrarAlerta("Introduce solo números en el ID Pedido", a);
                return;
            }

            if (b.value.trim() == "") {
                mostrarAlerta("El campo Costo Total no puede ir vacío", b);
                return;
            }

            if (c.value.trim() == "") {
                mostrarAlerta("El campo Estado no puede ir vacío", c);
                return;
            }
            if (!expRegTexto.test(c.value)) {
                mostrarAlerta("Introduce solo letras en el Estado", c);
                return;
            }

            if (d.value.trim() == "") {
                mostrarAlerta("El campo Método no puede ir vacío", d);
                return;
            }

            this.submit();
        });
    </script>
</body>
</html>