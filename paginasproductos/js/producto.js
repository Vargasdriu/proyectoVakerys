let productoActual = null;


// ==========================================
// SWEET ALERT
// ==========================================

function mostrarAlerta(mensaje, icono = "error") {

    Swal.fire({

        icon: icono,

        title:
            icono === "success"
                ? "¡Listo!"
                : "¡Oops!",

        text: mensaje,

        confirmButtonColor: "#62a38a",

        confirmButtonText: "Entendido"

    });

}


// ==========================================
// OBTENER DATOS DE LA URL
// ==========================================

const parametros = new URLSearchParams(
    window.location.search
);


const codigoProducto = parametros.get(
    "Codigo"
);


const idPedido = parametros.get(
    "idPedido"
);


// ==========================================
// COMPROBAR SI EXISTE UN PRODUCTO
// ==========================================

if (!codigoProducto) {

    mostrarAlerta(
        "No se encontró el producto."
    );

}


// ==========================================
// CARGAR PRODUCTOS
// ==========================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        cargarProducto();

    }
);


// ==========================================
// CARGAR PRODUCTO
// ==========================================

function cargarProducto() {

    fetch("obtenerproductos.php")

        .then(respuesta => {

            if (!respuesta.ok) {

                throw new Error(
                    "Error al cargar los productos."
                );

            }

            return respuesta.json();

        })

        .then(productos => {

            productoActual =
                productos.find(
                    producto =>
                        String(producto.Codigo) ===
                        String(codigoProducto)
                );


            if (!productoActual) {

                mostrarAlerta(
                    "No se encontró el producto."
                );

                return;

            }


            // ==========================================
            // NOMBRE
            // ==========================================

            document.getElementById(
                "nombreProducto"
            ).textContent =
                productoActual.NombreProducto;


            // ==========================================
            // PRECIO
            // ==========================================

            document.getElementById(
                "precioProducto"
            ).textContent =
                "Bs. " +
                Number(
                    productoActual.PrecioProducto
                ).toFixed(2);


            // ==========================================
            // DESCRIPCIÓN
            // ==========================================

            document.getElementById(
                "descripcionProducto"
            ).textContent =
                productoActual.DetalleProducto;


            // ==========================================
            // IMAGEN PRINCIPAL
            // ==========================================

            const imagenPrincipal =
                document.getElementById(
                    "imagenPrincipal"
                );


            imagenPrincipal.src =
                "../Productos/imagenes/" +
                (
                    productoActual.Imagen || ""
                );


            imagenPrincipal.alt =
                productoActual.NombreProducto;


            // ==========================================
            // MINIATURA
            // ==========================================

            const miniaturas =
                document.getElementById(
                    "miniaturas"
                );


            miniaturas.innerHTML = `

                <img
                    src="../Productos/imagenes/${productoActual.Imagen || ""}"
                    alt="${productoActual.NombreProducto}"
                    class="miniatura activa"
                >

            `;


            const miniatura =
                miniaturas.querySelector(
                    ".miniatura"
                );


            if (miniatura) {

                miniatura.addEventListener(
                    "click",
                    function () {

                        imagenPrincipal.src =
                            this.src;

                    }
                );

            }


        })

        .catch(error => {

            console.log(
                "Error:",
                error
            );


            mostrarAlerta(
                "No se pudo cargar el producto."
            );

        });

}


// ==========================================
// BOTÓN MENOS
// ==========================================

document.getElementById(
    "btnMenos"
).addEventListener(
    "click",
    function () {

        const cantidadElemento =
            document.getElementById(
                "cantidadProducto"
            );


        let cantidad =
            parseInt(
                cantidadElemento.textContent
            );


        cantidad--;


        if (cantidad < 1) {

            cantidad = 1;

        }


        cantidadElemento.textContent =
            cantidad;

    }
);


// ==========================================
// BOTÓN MÁS
// ==========================================

document.getElementById(
    "btnMas"
).addEventListener(
    "click",
    function () {

        const cantidadElemento =
            document.getElementById(
                "cantidadProducto"
            );


        let cantidad =
            parseInt(
                cantidadElemento.textContent
            );


        cantidad++;


        cantidadElemento.textContent =
            cantidad;

    }
);


// ==========================================
// AÑADIR AL CARRITO
// ==========================================

document.getElementById(
    "botonCarrito"
).addEventListener(
    "click",
    function () {


        // ==========================================
        // COMPROBAR PRODUCTO
        // ==========================================

        if (!productoActual) {

            mostrarAlerta(
                "El producto todavía no se cargó correctamente."
            );

            return;

        }


        // ==========================================
        // COMPROBAR PEDIDO
        // ==========================================

        if (!idPedido) {

            Swal.fire({

                icon: "error",

                title: "¡Primero crea tu pedido!",

                text:
                    "Para añadir productos al carrito primero debes crear un pedido.",

                confirmButtonColor:
                    "#62a38a",

                confirmButtonText:
                    "Crear pedido"

            })

            .then(() => {

                window.location.href =
                    "crearpedidocliente.php";

            });


            return;

        }


        // ==========================================
        // OBTENER CANTIDAD
        // ==========================================

        const cantidad =
            parseInt(
                document.getElementById(
                    "cantidadProducto"
                ).textContent
            );


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
                        productoActual.Codigo
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
                "Respuesta carrito.php:",
                texto
            );


            let datos;


            try {

                datos =
                    JSON.parse(
                        texto
                    );

            }

            catch (error) {

                console.log(
                    "carrito.php no devolvió JSON:"
                );


                console.log(
                    texto
                );


                mostrarAlerta(
                    "Hubo un error al procesar el carrito."
                );


                return;

            }


            // ==========================================
            // PRODUCTO AGREGADO
            // ==========================================

            if (datos.ok) {

                Swal.fire({

                    icon: "success",

                    title:
                        "¡Producto añadido!",

                    text:
                        datos.mensaje,

                    confirmButtonColor:
                        "#62a38a",

                    confirmButtonText:
                        "Seguir comprando"

                })

                .then(() => {

                    // Reiniciar cantidad

                    document.getElementById(
                        "cantidadProducto"
                    ).textContent =
                        "1";


                    // Actualizar carrito si existe
                    // la función global

                    if (
                        typeof actualizarCarrito ===
                        "function"
                    ) {

                        actualizarCarrito();

                    }

                });

            }


            // ==========================================
            // ERROR
            // ==========================================

            else {

                mostrarAlerta(
                    datos.mensaje
                );

            }

        })


        .catch(error => {

            console.log(
                "Error al conectar con carrito.php:",
                error
            );


            mostrarAlerta(
                "No se pudo conectar con el carrito."
            );

        });

    }
);