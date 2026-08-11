

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi Tienda</title>

    <link rel="stylesheet" href="css/estilos.css">

</head>

<body>

    <!--================== CABECERA ==================-->

    <header>

        <div class="logo">

            🛍 <span>MI TIENDA</span>

        </div>

        <div class="busqueda">

            <input
                type="text"
                id="buscar"
                placeholder="Buscar producto...">

        </div>

        <div id="carritoIcono">

            🛒 <span id="cantidadCarrito">0</span>

        </div>

    </header>

    <!--================== PRODUCTOS ==================-->

    <main>

        <h2 class="titulo">
            Productos Disponibles
        </h2>

        <section id="productos">

        </section>

    </main>
    
   <button id="generarPedido">
Generar Pedido
</button>


</div>
<!--================== FONDO OSCURO ==================-->

    <div id="fondo"></div>

    <!--================== SIDEBAR ==================-->

    <aside id="sidebar">

        <div class="sidebarHeader">

            <h2>🛒 Mi Carrito</h2>

            <button id="cerrarCarrito">✖</button>

        </div>

        <div id="contenidoCarrito">

        </div>

        <div class="sidebarFooter">

            <h3 id="totalCarrito">

                Total: Bs 0

            </h3>

            <button id="vaciarCarrito">

                Vaciar carrito

            </button>

            <button id="comprar">

                Comprar

            </button>

        </div>

    </aside>
 



<!--================== MODAL COMPRA ==================-->

<div id="modalCompra" class="modal">

    <div class="modalContenido">

        <h2>🛍 Finalizar Compra</h2>

        <input type="text"
               id="nombre"
               placeholder="Nombre completo">

        <input type="text"
               id="telefono"
               placeholder="Teléfono">

        <input type="text"
               id="direccion"
               placeholder="Dirección">

        <select id="metodoPago">

            <option value="QR">Pago mediante QR</option>

            <option value="Efectivo">Pago en efectivo</option>

        </select>

        <div class="botonesModal">

            <button id="confirmarPedido">
                Confirmar Compra
            </button>

            <button id="cancelarCompra">
                Cancelar
            </button>

        </div>

    </div>

</div>

</div>
    


<script src="js/productos.js"></script>
<script src="js/pedido.js"></script>
<script src="js/carrito.js"></script>

</body>

</html>