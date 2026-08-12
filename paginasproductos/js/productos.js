let listaProductos = [];
let pedidoActivo = false;


// ==========================================
// INICIAR
// ==========================================

document.addEventListener("DOMContentLoaded", () => {

    mostrarProductos();

});


// ==========================================
// MOSTRAR PRODUCTOS
// ==========================================

function mostrarProductos() {

    fetch("obtenerproductos.php")

        .then(respuesta => {

            if (!respuesta.ok) {

                throw new Error(
                    "Error HTTP: " + respuesta.status
                );

            }

            return respuesta.json();

        })

        .then(productos => {

            console.log("Productos:", productos);

            listaProductos = productos;

            let contenedor =
                document.getElementById("productos");


            if (!contenedor) {

                console.log(
                    "No existe el elemento #productos"
                );

                return;

            }


            contenedor.innerHTML = "";


            productos.forEach(producto => {

                contenedor.innerHTML += `

                    <div class="proc">

                        <img
                            class="imgb"
                            src="../Productos/${producto.Imagen}"
                            alt="${producto.NombreProducto}"
                        >


                        <div class="ba">

                            <h1>
                                ${producto.NombreProducto}
                            </h1>

                            <p>
                                ${producto.DetalleProducto}
                            </p>

                        </div>


                        <div class="bb">

                            <h1 class="precio">
                                Bs. ${producto.PrecioProducto}
                            </h1>


                            <div class="cantidad">

                                <button
                                    type="button"
                                    class="btnCantidad"
                                    data-codigo="${producto.Codigo}"
                                    data-cambio="-1"
                                >
                                    -
                                </button>


                                <span
                                    id="cantidad-${producto.Codigo}"
                                >
                                    1
                                </span>


                                <button
                                    type="button"
                                    class="btnCantidad"
                                    data-codigo="${producto.Codigo}"
                                    data-cambio="1"
                                >
                                    +
                                </button>

                            </div>


                            <button
                                type="button"
                                class="anadir"
                                data-codigo="${producto.Codigo}"
                            >

                                <img
                                    class="carro"
                                    src="../imagenes/anadir-al-carrito.png"
                                    alt="Añadir al carrito"
                                >

                                <p>
                                    Añadir
                                </p>

                            </button>

                        </div>

                    </div>

                `;

            });


            // ==================================
            // BOTONES + Y -
            // ==================================

            document
                .querySelectorAll(".btnCantidad")
                .forEach(boton => {

                    boton.addEventListener(
                        "click",
                        function(event) {

                            event.preventDefault();
                            event.stopPropagation();


                            let codigo =
                                this.dataset.codigo;


                            let cambio =
                                parseInt(
                                    this.dataset.cambio
                                );


                            cambiarCantidad(
                                codigo,
                                cambio
                            );

                        }
                    );

                });


            // ==================================
            // BOTONES AÑADIR
            // ==================================

            document
                .querySelectorAll(".anadir")
                .forEach(boton => {

                    boton.addEventListener(
                        "click",
                        function(event) {

                            event.preventDefault();
                            event.stopPropagation();


                            let codigo =
                                this.dataset.codigo;


                            anadirAlCarrito(
                                codigo
                            );

                        }
                    );

                });

        })

        .catch(error => {

            console.log(
                "Error al cargar productos:",
                error
            );

        });

}


// ==========================================
// CAMBIAR CANTIDAD
// ==========================================

function cambiarCantidad(
    codigo,
    cambio
) {

    let span =
        document.getElementById(
            "cantidad-" + codigo
        );


    if (!span) {

        return;

    }


    let cantidad =
        parseInt(
            span.textContent
        );


    cantidad += cambio;


    if (cantidad < 1) {

        cantidad = 1;

    }


    span.textContent =
        cantidad;

}


// ==========================================
// AÑADIR AL CARRITO
// ==========================================

function anadirAlCarrito(
    codigo
) {

    let span =
        document.getElementById(
            "cantidad-" + codigo
        );


    if (!span) {

        alert(
            "No se encontró la cantidad del producto."
        );

        return;

    }


    let cantidad =
        parseInt(
            span.textContent
        );


    if (cantidad < 1) {

        cantidad = 1;

    }


    // ==========================================
    // OBTENER ID DEL PEDIDO DE LA URL
    // ==========================================

    const parametros =
        new URLSearchParams(
            window.location.search
        );


    const idPedido =
        parametros.get("idPedido");


    console.log(
        "Código:",
        codigo
    );


    console.log(
        "Cantidad:",
        cantidad
    );


    console.log(
        "ID DEL PEDIDO:",
        idPedido
    );


    // ==========================================
    // COMPROBAR ID DEL PEDIDO
    // ==========================================

    if (!idPedido) {

        alert(
            "No se encontró el ID del pedido."
        );

        return;

    }


    // ==========================================
    // ENVIAR A carrito.php
    // ==========================================

    fetch("carrito.php", {

        method: "POST",

        headers: {

            "Content-Type":
                "application/x-www-form-urlencoded"

        },

        body:
            "accion=agregar" +
            "&codigo=" +
            encodeURIComponent(codigo) +
            "&cantidad=" +
            encodeURIComponent(cantidad) +
            "&idPedido=" +
            encodeURIComponent(idPedido)

    })


    .then(respuesta => {

        console.log(
            "Estado HTTP:",
            respuesta.status
        );


        return respuesta.text();

    })


    .then(texto => {

        console.log(
            "RESPUESTA DE carrito.php:"
        );


        console.log(texto);


        // ==================================
        // CONVERTIR RESPUESTA A JSON
        // ==================================

        let datos;


        try {

            datos =
                JSON.parse(texto);

        }

        catch(error) {

            console.log(
                "carrito.php NO devolvió JSON"
            );


            console.log(
                "Respuesta recibida:",
                texto
            );


            alert(
                "carrito.php está devolviendo un error. Revisa F12 > Console."
            );


            return;

        }


        console.log(
            "Datos recibidos:",
            datos
        );


        // ==================================
        // PRODUCTO AGREGADO
        // ==================================

        if (datos.ok) {

            alert(
                datos.mensaje
            );


            // Reiniciar cantidad

            span.textContent = "1";


            // Actualizar carrito

            if (
                typeof actualizarCarrito ===
                "function"
            ) {

                actualizarCarrito();

            }

        }


        // ==================================
        // ERROR
        // ==================================

        else {

            alert(
                datos.mensaje
            );

        }

    })


    .catch(error => {

        console.log(
            "ERROR REAL AL CONECTAR CON carrito.php:"
        );


        console.log(error);


        alert(
            "Error al conectar con carrito.php"
        );

    });

}


// ==========================================
// HABILITAR COMPRA
// ==========================================

function habilitarCompra() {

    pedidoActivo = true;


    document
        .querySelectorAll(".anadir")
        .forEach(boton => {

            boton.disabled = false;

        });

}