
/* ==========================================
   MOSTRAR PRODUCTOS
========================================== */

function mostrarProductos() {

    fetch("obtenerProductos.php")

        .then(respuesta => respuesta.json())

        .then(productos => {

            let contenedor =
                document.getElementById("productos");

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


            /* ==================================
               BOTONES + Y -
            ================================== */

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


            /* ==================================
               BOTONES AÑADIR
            ================================== */

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


/* ==========================================
   CAMBIAR CANTIDAD
========================================== */

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
        parseInt(span.textContent);


    cantidad += cambio;


    if (cantidad < 1) {
        cantidad = 1;
    }


    span.textContent =
        cantidad;

}


/* ==========================================
   AÑADIR AL CARRITO
========================================== */

function anadirAlCarrito(
    codigo
) {

    let span =
        document.getElementById(
            "cantidad-" + codigo
        );


    if (!span) {
        return;
    }


    let cantidad =
        parseInt(span.textContent);


    console.log(
        "Código:",
        codigo
    );

    console.log(
        "Cantidad:",
        cantidad
    );


    fetch("php/carrito.php", {

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
            encodeURIComponent(cantidad)

    })

        .then(respuesta => {

            console.log(
                "Respuesta recibida"
            );

            return respuesta.json();

        })

        .then(datos => {

            console.log(
                "Datos:",
                datos
            );


            if (datos.ok) {

                alert(
                    "Producto añadido al carrito"
                );


                span.textContent =
                    "1";


                if (
                    typeof actualizarCarrito ===
                    "function"
                ) {

                    actualizarCarrito();

                }

            } else {

                alert(
                    datos.mensaje
                );

            }

        })

        .catch(error => {

            console.log(
                "ERROR:",
                error
            );

            alert(
                "Error al conectar con carrito.php"
            );

        });

}


/* ==========================================
   INICIAR
========================================== */

mostrarProductos();

