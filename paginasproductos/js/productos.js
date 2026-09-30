let listaProductos = [];
let pedidoActivo = false;


// ==========================================
// SWEET ALERT
// ==========================================

function mostrarAlerta(mensaje, elemento = null, icono = "error") {

    Swal.fire({
        icon: icono,
        title: icono === "success" ? "¡Listo!" : "¡Oops!",
        text: mensaje,
        confirmButtonColor: "#62a38a",
        confirmButtonText: "Entendido"

    }).then(() => {

        if (elemento) {
            elemento.focus();
        }

    });

}


// ==========================================
// OBTENER PEDIDO ACTIVO
// ==========================================

function obtenerIdPedido() {

    const parametros =
        new URLSearchParams(
            window.location.search
        );

    let idPedido =
        parametros.get("idPedido");


    if (idPedido) {

        sessionStorage.setItem(
            "idPedido",
            idPedido
        );

    } else {

        idPedido =
            sessionStorage.getItem(
                "idPedido"
            );

    }


    return idPedido;
}


// ==========================================
// CARGAR PRODUCTOS
// ==========================================

document.addEventListener("DOMContentLoaded", () => {

    // Guardar el pedido activo al entrar
    obtenerIdPedido();

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
                    "Error HTTP: " +
                    respuesta.status
                );

            }

            return respuesta.json();

        })

        .then(productos => {

            console.log(
                "Productos:",
                productos
            );

            listaProductos = productos;

            const contenedor =
                document.getElementById(
                    "productos"
                );


            if (!contenedor) {

                console.log(
                    "No existe el elemento #productos"
                );

                return;

            }


            contenedor.innerHTML = "";


            productos.forEach(producto => {

                const idPedido =
                    obtenerIdPedido();


                let enlaceProducto =
                    "../paginasproductos/producto.php?Codigo=" +
                    encodeURIComponent(
                        producto.Codigo
                    );


                if (idPedido) {

                    enlaceProducto +=
                        "&idPedido=" +
                        encodeURIComponent(
                            idPedido
                        );

                }


                contenedor.innerHTML += `

                    <div
                        class="proc"
                        data-codigo="${producto.Codigo}"
                    >

                        <a
                            href="${enlaceProducto}"
                            class="enlace-producto"
                        >

                            <img
                                class="imgb"
                                src="../Productos/imagenes/${producto.Imagen || ''}"
                                alt="${producto.NombreProducto}"
                            >

                        </a>


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


            // ==========================================
            // ABRIR PRODUCTO INDIVIDUAL
            // ==========================================

            document
                .querySelectorAll(".proc")
                .forEach(tarjeta => {

                    tarjeta.addEventListener(
                        "click",
                        function(event) {

                            if (
                                event.target.closest(
                                    ".btnCantidad"
                                )
                            ) {
                                return;
                            }


                            if (
                                event.target.closest(
                                    ".anadir"
                                )
                            ) {
                                return;
                            }


                            const Codigo =
                                this.dataset.codigo;


                            if (!Codigo) {

                                console.log(
                                    "No se encontró el código del producto"
                                );

                                return;

                            }


                            const idPedido =
                                obtenerIdPedido();


                            let url =
                                "producto.php?Codigo=" +
                                encodeURIComponent(
                                    Codigo
                                );


                            if (idPedido) {

                                url +=
                                    "&idPedido=" +
                                    encodeURIComponent(
                                        idPedido
                                    );

                            }


                            console.log(
                                "ID DEL PEDIDO:",
                                idPedido
                            );


                            console.log(
                                "Abriendo:",
                                url
                            );


                            window.location.href =
                                url;

                        }

                    );

                });


            // ==========================================
            // BOTONES + Y -
            // ==========================================

            document
                .querySelectorAll(".btnCantidad")
                .forEach(boton => {

                    boton.addEventListener(
                        "click",
                        function(event) {

                            event.preventDefault();

                            event.stopPropagation();


                            const codigo =
                                this.dataset.codigo;


                            const cambio =
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


            // ==========================================
            // BOTONES AÑADIR
            // ==========================================

            document
                .querySelectorAll(".anadir")
                .forEach(boton => {

                    boton.addEventListener(
                        "click",
                        function(event) {

                            event.preventDefault();

                            event.stopPropagation();


                            const codigo =
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

    const span =
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

    const span =
        document.getElementById(
            "cantidad-" + codigo
        );


    if (!span) {

        mostrarAlerta(
            "No se encontró la cantidad del producto.",
            null,
            "error"
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
    // OBTENER PEDIDO ACTIVO
    // ==========================================

    const idPedido =
        obtenerIdPedido();


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
    // COMPROBAR PEDIDO
    // ==========================================

    if (!idPedido) {

        Swal.fire({

            icon: "error",

            title: "¡Oops!",

            text:
                "No se encontró el ID del pedido.",

            confirmButtonColor:
                "#62a38a",

            confirmButtonText:
                "Crear pedido"

        }).then(() => {

            window.location.href =
                "crearpedidocliente.php";

        });


        return;

    }


    // ==========================================
    // ENVIAR AL CARRITO
    // ==========================================

    fetch(
        "carrito.php",
        {

            method: "POST",

            headers: {

                "Content-Type":
                    "application/x-www-form-urlencoded"

            },


            body:

                "accion=agregar" +

                "&codigo=" +
                encodeURIComponent(
                    codigo
                ) +

                "&cantidad=" +
                encodeURIComponent(
                    cantidad
                ) +

                "&idPedido=" +
                encodeURIComponent(
                    idPedido
                )

        }

    )

        .then(respuesta => {

            console.log(
                "Estado HTTP:",
                respuesta.status
            );


            return respuesta.text();

        })


        .then(texto => {

            console.log(
                "RESPUESTA DE carrito.php:",
                texto
            );


            let datos;


            try {

                datos =
                    JSON.parse(
                        texto
                    );

            }

            catch(error) {

                console.log(
                    "carrito.php NO devolvió JSON"
                );


                console.log(
                    "Respuesta recibida:",
                    texto
                );


                Swal.fire({

                    icon: "error",

                    title: "¡Oops!",

                    text:
                        "carrito.php está devolviendo un error. Revisa F12 > Console.",

                    confirmButtonColor:
                        "#62a38a",

                    confirmButtonText:
                        "Entendido"

                });


                return;

            }


            console.log(
                "Datos recibidos:",
                datos
            );


            // ==========================================
            // PRODUCTO AGREGADO CORRECTAMENTE
            // ==========================================

            if (datos.ok) {

                mostrarAlerta(
                    datos.mensaje,
                    null,
                    "success"
                );


                span.textContent =
                    "1";


                if (
                    typeof actualizarCarrito ===
                    "function"
                ) {

                    actualizarCarrito();

                }

            }


            else {

                mostrarAlerta(
                    datos.mensaje,
                    null,
                    "error"
                );

            }

        })


        .catch(error => {

            console.log(
                "ERROR REAL AL CONECTAR CON carrito.php:"
            );


            console.log(
                error
            );


            Swal.fire({

                icon: "error",

                title: "¡Oops!",

                text:
                    "Error al conectar con carrito.php",

                confirmButtonColor:
                    "#62a38a",

                confirmButtonText:
                    "Entendido"

            });

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
