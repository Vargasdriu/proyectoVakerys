//==============================
// ABRIR CARRITO
//==============================

let carrito = document.getElementById("carrito");

if (carrito) {

    carrito.addEventListener(
        "click",
        function(e) {

            e.preventDefault();

            let sidebar =
                document.getElementById("sidebar");

            let fondo =
                document.getElementById("fondo");


            if (sidebar) {

                sidebar.classList.add("activo");

            }


            if (fondo) {

                fondo.classList.add("activo");

            }


            actualizarCarrito();

        }
    );

}


//==============================
// CERRAR CARRITO
//==============================

let cerrarCarrito =
    document.getElementById("cerrarCarrito");


if (cerrarCarrito) {

    cerrarCarrito.addEventListener(
        "click",
        cerrarSidebar
    );

}


let fondo =
    document.getElementById("fondo");


if (fondo) {

    fondo.addEventListener(
        "click",
        cerrarSidebar
    );

}


function cerrarSidebar() {

    let sidebar =
        document.getElementById("sidebar");


    let fondo =
        document.getElementById("fondo");


    if (sidebar) {

        sidebar.classList.remove("activo");

    }


    if (fondo) {

        fondo.classList.remove("activo");

    }

}


//==============================
// ACTUALIZAR CARRITO
//==============================

function actualizarCarrito() {

    fetch("../paginasproductos/carrito.php", {

        method: "POST",

        headers: {

            "Content-Type":
                "application/x-www-form-urlencoded"

        },

        body:
            "accion=mostrar"

    })


        .then(res => {

            console.log(
                "Estado carrito:",
                res.status
            );

            return res.text();

        })


        .then(texto => {

            console.log(
                "Respuesta carrito:",
                texto
            );


            let datos;


            try {

                datos =
                    JSON.parse(texto);

            }

            catch(error) {

                console.log(
                    "carrito.php no devolvió JSON"
                );

                console.log(texto);

                return;

            }


            console.log(
                "Carrito:",
                datos
            );


            //==============================
            // SI HAY ERROR
            //==============================

            if (!Array.isArray(datos)) {

                alert(
                    datos.mensaje
                );

                return;

            }


            let html = "";

            let total = 0;

            let cantidadTotal = 0;


            //==============================
            // MOSTRAR PRODUCTOS
            //==============================

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
                                ${Number(
                                    producto.PrecioProducto
                                ).toFixed(2)}
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


            //==============================
            // SI ESTÁ VACÍO
            //==============================

            if (datos.length === 0) {

                html = `

                    <div class="carritoVacio">

                        <p>
                            Tu carrito está vacío.
                        </p>

                    </div>

                `;

            }


            //==============================
            // INSERTAR PRODUCTOS
            //==============================

            let contenido =
                document.getElementById(
                    "contenidoCarrito"
                );


            if (contenido) {

                contenido.innerHTML =
                    html;

            }


            //==============================
            // CANTIDAD
            //==============================

            let cantidadCarrito =
                document.getElementById(
                    "cantidadCarrito"
                );


            if (cantidadCarrito) {

                cantidadCarrito.innerHTML =
                    cantidadTotal;

            }


            //==============================
            // TOTAL
            //==============================

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


    fetch("../paginasproductos/carrito.php", {

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

            }

            else {

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

        if (e.target.id !== "comprar") {
            return;
        }


        // Obtener idPedido de la URL

        const url =
            new URLSearchParams(
                window.location.search
            );

        const idPedido =
            url.get("idPedido");


        console.log(
            "ID DEL PEDIDO:",
            idPedido
        );


        if (!idPedido) {

            alert(
                "No se encontró el ID del pedido."
            );

            return;
        }


        // Enviar pedido a PHP

        fetch(
            "../paginasproductos/finalizarpedido.php",
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/x-www-form-urlencoded"
                },

                body:
                    "idPedido=" +
                    encodeURIComponent(idPedido)
            }
        )

        .then(
            respuesta => {

                console.log(
                    "Estado:",
                    respuesta.status
                );

                return respuesta.text();
            }
        )

        .then(
            texto => {

                console.log(
                    "Respuesta PHP:",
                    texto
                );


                let datos;

                try {

                    datos =
                        JSON.parse(texto);

                } catch(error) {

                    console.log(
                        "PHP no devolvió JSON"
                    );

                    console.log(texto);

                    alert(
                        "Hubo un error en el servidor."
                    );

                    return;
                }


                if (datos.ok) {

                    

                    window.location.href =
                        "recibo.php";

                }

                else {

                    alert(
                        datos.mensaje
                    );

                }

            }
        )

        .catch(
            error => {

                console.log(
                    "Error al finalizar:",
                    error
                );

                alert(
                    "No se pudo finalizar el pedido."
                );

            }
        );

    }
);