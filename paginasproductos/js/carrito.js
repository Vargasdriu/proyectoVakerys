//==============================
// ABRIR CARRITO
//==============================

let carrito =
    document.getElementById("carrito");


if (carrito) {

    carrito.addEventListener(
        "click",
        function(e) {

            e.preventDefault();


            let sidebar =
                document.getElementById(
                    "sidebar"
                );


            let fondo =
                document.getElementById(
                    "fondo"
                );


            if (sidebar) {

                sidebar.classList.add(
                    "activo"
                );

            }


            if (fondo) {

                fondo.classList.add(
                    "activo"
                );

            }


            actualizarCarrito();

        }
    );

}


//==============================
// CERRAR CARRITO
//==============================

let cerrarCarrito =
    document.getElementById(
        "cerrarCarrito"
    );


if (cerrarCarrito) {

    cerrarCarrito.addEventListener(
        "click",
        cerrarSidebar
    );

}


let fondo =
    document.getElementById(
        "fondo"
    );


if (fondo) {

    fondo.addEventListener(
        "click",
        cerrarSidebar
    );

}


function cerrarSidebar() {

    let sidebar =
        document.getElementById(
            "sidebar"
        );


    let fondo =
        document.getElementById(
            "fondo"
        );


    if (sidebar) {

        sidebar.classList.remove(
            "activo"
        );

    }


    if (fondo) {

        fondo.classList.remove(
            "activo"
        );

    }

}


//==============================
// ACTUALIZAR CARRITO
//==============================

function actualizarCarrito() {

    fetch("php/carrito.php", {

        method: "POST",

        headers: {
            "Content-Type":
                "application/x-www-form-urlencoded"
        },

        body:
            "accion=mostrar"

    })

        .then(res => res.json())

        .then(datos => {

            console.log(
                "Carrito:",
                datos
            );


            if (
                !Array.isArray(datos)
            ) {

                alert(
                    datos.mensaje
                );

                return;

            }


            let html = "";

            let total = 0;

            let cantidadTotal = 0;


            datos.forEach(
                producto => {

                    let cantidad =
                        Number(
                            producto.Cantidad
                        );


                    let subtotal =
                        Number(
                            producto.CostoTotal
                        );


                    total += subtotal;

                    cantidadTotal +=
                        cantidad;


                    html += `

                        <div
                            class="productoCarrito"
                        >

                            <h3>
                                ${producto.NombreProducto}
                            </h3>


                            <p>
                                Cantidad:
                                ${cantidad}
                            </p>


                            <p>
                                Precio:
                                Bs.
                                ${producto.PrecioProducto}
                            </p>


                            <p>
                                Subtotal:
                                Bs.
                                ${subtotal.toFixed(2)}
                            </p>

                        </div>

                    `;

                }
            );


            let contenido =
                document.getElementById(
                    "contenidoCarrito"
                );


            if (contenido) {

                contenido.innerHTML =
                    html;

            }


            let cantidadCarrito =
                document.getElementById(
                    "cantidadCarrito"
                );


            if (cantidadCarrito) {

                cantidadCarrito.innerHTML =
                    cantidadTotal;

            }


            let totalCarrito =
                document.getElementById(
                    "totalCarrito"
                );


            if (totalCarrito) {

                totalCarrito.innerHTML =
                    "Total: Bs " +
                    total.toFixed(2);

            }

        })

        .catch(error => {

            console.log(
                "Error carrito:",
                error
            );

        });

}


//==============================
// VACIAR CARRITO
//==============================

let vaciar =
    document.getElementById(
        "vaciarCarrito"
    );


if (vaciar) {

    vaciar.addEventListener(
        "click",
        vaciarCarrito
    );

}


function vaciarCarrito() {

    if (
        !confirm(
            "¿Desea vaciar todo el carrito?"
        )
    ) {

        return;

    }


    fetch("php/carrito.php", {

        method: "POST",

        headers: {
            "Content-Type":
                "application/x-www-form-urlencoded"
        },

        body:
            "accion=vaciar"

    })

        .then(res => res.json())

        .then(datos => {

            if (datos.ok) {

                actualizarCarrito();

            } else {

                alert(
                    datos.mensaje
                );

            }

        })

        .catch(error => {

            console.log(
                "Error:",
                error
            );

        });

}


//==============================
// FINALIZAR COMPRA
//==============================

document.addEventListener(
    "click",
    function(e) {

        if (
            e.target.id ===
            "comprar"
        ) {

            fetch(
                "php/finalizar_pedido.php"
            )

                .then(
                    res => res.json()
                )

                .then(
                    data => {

                        if (data.ok) {

                            window.location.href =
                                "recibo.php";

                        } else {

                            alert(
                                data.mensaje
                            );

                        }

                    }
                )

                .catch(
                    error => {

                        console.log(
                            "Error al finalizar pedido:",
                            error
                        );

                    }
                );

        }

    }
);