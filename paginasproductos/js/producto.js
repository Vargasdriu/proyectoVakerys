let pedidoActivo = false;

function mostrarAlerta(mensaje, elemento = null, icono = "error") {

    if (typeof Swal === "undefined") {
        alert(mensaje);

        if (elemento) {
            elemento.focus();
        }

        return;
    }

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

document.addEventListener("DOMContentLoaded", () => {
    cargarProducto();
});

function cargarProducto() {

    const parametros =
        new URLSearchParams(
            window.location.search
        );

    const codigo =
        parametros.get("Codigo") ||
        parametros.get("codigo");

    const idPedido =
        parametros.get("idPedido");

    if (!codigo) {

        mostrarAlerta(
            "No se encontró el código del producto."
        );

        return;
    }

    fetch(
        "obtenerproducto.php?codigo=" +
        encodeURIComponent(codigo)
    )

    .then(respuesta => {

        if (!respuesta.ok) {

            throw new Error(
                "Error HTTP: " +
                respuesta.status
            );

        }

        return respuesta.json();

    })

    .then(producto => {

        if (!producto || producto.error) {

            mostrarAlerta(
                producto?.error ||
                "No se encontró el producto."
            );

            return;
        }

        const nombreProducto =
            document.getElementById(
                "nombreProducto"
            );

        const precioProducto =
            document.getElementById(
                "precioProducto"
            );

        const descripcionProducto =
            document.getElementById(
                "descripcionProducto"
            );

        if (nombreProducto) {

            nombreProducto.textContent =
                producto.NombreProducto;

        }

        if (precioProducto) {

            precioProducto.textContent =
                Number(
                    producto.PrecioProducto
                ).toFixed(2) +
                " Bs";

        }

        if (descripcionProducto) {

            descripcionProducto.textContent =
                producto.DetalleProducto ||
                "Sin descripción disponible.";

        }

        const imagenPrincipal =
            document.getElementById(
                "imagenPrincipal"
            );

        const miniaturas =
            document.getElementById(
                "miniaturas"
            );

        if (miniaturas) {

            miniaturas.innerHTML = "";

        }

        if (
            producto.Imagen &&
            imagenPrincipal &&
            miniaturas
        ) {

            const ruta =
                "../Productos/imagenes/" +
                producto.Imagen;

            imagenPrincipal.src =
                ruta;

            imagenPrincipal.alt =
                producto.NombreProducto;

            const miniatura =
                document.createElement("img");

            miniatura.src =
                ruta;

            miniatura.alt =
                producto.NombreProducto;

            miniatura.classList.add(
                "activa"
            );

            miniatura.addEventListener(
                "click",
                () => {

                    cambiarImagen(
                        ruta,
                        miniatura
                    );

                }
            );

            miniaturas.appendChild(
                miniatura
            );
        }

        configurarCantidad();

        configurarCarrito(
            codigo
        );

        if (idPedido) {

            habilitarCompra();

        }

    })

    .catch(error => {

        console.error(
            "Error al cargar producto:",
            error
        );

        mostrarAlerta(
            "No se pudo cargar el producto."
        );

    });
}

function configurarCantidad() {

    const btnMenos =
        document.getElementById(
            "btnMenos"
        );

    const btnMas =
        document.getElementById(
            "btnMas"
        );

    const cantidad =
        document.getElementById(
            "cantidadProducto"
        );

    if (
        !btnMenos ||
        !btnMas ||
        !cantidad
    ) {

        return;
    }

    btnMenos.addEventListener(
        "click",
        event => {

            event.preventDefault();

            let valor =
                parseInt(
                    cantidad.textContent
                );

            if (
                isNaN(valor) ||
                valor < 1
            ) {

                valor = 1;

            }

            if (valor > 1) {

                valor--;

            }

            cantidad.textContent =
                valor;

        }
    );

    btnMas.addEventListener(
        "click",
        event => {

            event.preventDefault();

            let valor =
                parseInt(
                    cantidad.textContent
                );

            if (
                isNaN(valor) ||
                valor < 1
            ) {

                valor = 1;

            }

            valor++;

            cantidad.textContent =
                valor;

        }
    );
}

function configurarCarrito(codigo) {

    const boton =
        document.getElementById(
            "botonCarrito"
        );

    if (!boton) {

        console.log(
            "No existe el botón #botonCarrito"
        );

        return;
    }

    boton.addEventListener(
        "click",
        function(event) {

            event.preventDefault();

            const cantidadElemento =
                document.getElementById(
                    "cantidadProducto"
                );

            if (!cantidadElemento) {

                mostrarAlerta(
                    "No se encontró la cantidad del producto."
                );

                return;
            }

            let cantidad =
                parseInt(
                    cantidadElemento.textContent
                );

            if (
                isNaN(cantidad) ||
                cantidad < 1
            ) {

                cantidad = 1;

            }

            const parametros =
                new URLSearchParams(
                    window.location.search
                );

            const idPedido =
                parametros.get(
                    "idPedido"
                );

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

            if (!idPedido) {

                if (
                    typeof Swal ===
                    "undefined"
                ) {

                    alert(
                        "No se encontró el ID del pedido."
                    );

                    window.location.href =
                        "crearpedidocliente.php";

                    return;
                }

                Swal.fire({

                    icon: "error",

                    title: "¡Oops!",

                    text:
                        "No se encontró el ID del pedido.",

                    confirmButtonColor:
                        "#62a38a",

                    confirmButtonText:
                        "Entendido"

                })

                .then(() => {

                    window.location.href =
                        "crearpedidocliente.php";

                });

                return;
            }

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
                    "RESPUESTA DE carrito.php:"
                );

                console.log(
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

                    console.error(
                        "carrito.php NO devolvió JSON"
                    );

                    console.error(
                        "Respuesta recibida:",
                        texto
                    );

                    if (
                        typeof Swal !==
                        "undefined"
                    ) {

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

                    }

                    else {

                        alert(
                            "carrito.php está devolviendo un error. Revisa F12 > Console."
                        );

                    }

                    return;
                }

                console.log(
                    "Datos recibidos:",
                    datos
                );

                if (datos.ok) {

                    mostrarAlerta(
                        datos.mensaje ||
                        "Producto añadido al pedido.",
                        null,
                        "success"
                    );

                    cantidadElemento.textContent =
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
                        datos.mensaje ||
                        "No se pudo añadir el producto.",
                        null,
                        "error"
                    );

                }

            })

            .catch(error => {

                console.error(
                    "ERROR REAL AL CONECTAR CON carrito.php:"
                );

                console.error(
                    error
                );

                if (
                    typeof Swal !==
                    "undefined"
                ) {

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

                }

                else {

                    alert(
                        "Error al conectar con carrito.php"
                    );

                }

            });

        }
    );
}

function habilitarCompra() {

    pedidoActivo = true;

    const boton =
        document.getElementById(
            "botonCarrito"
        );

    if (boton) {

        boton.disabled = false;

        boton.classList.remove(
            "deshabilitado"
        );

    }
}

function cambiarImagen(
    ruta,
    miniatura
) {

    const imagenPrincipal =
        document.getElementById(
            "imagenPrincipal"
        );

    if (!imagenPrincipal) {

        return;

    }

    imagenPrincipal.src =
        ruta;

    document
        .querySelectorAll(
            "#miniaturas img"
        )
        .forEach(img => {

            img.classList.remove(
                "activa"
            );

        });

    if (miniatura) {

        miniatura.classList.add(
            "activa"
        );

    }
}