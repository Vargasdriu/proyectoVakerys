function cargarProducto() {

    const parametros = new URLSearchParams(window.location.search);

    const codigo =
        parametros.get("Codigo") ||
        parametros.get("codigo");

    const idPedido =
        parametros.get("idPedido");

    console.log("=================================");
    console.log("CARGANDO PRODUCTO");
    console.log("Código:", codigo);
    console.log("ID Pedido:", idPedido);
    console.log("=================================");

    if (!codigo) {

        console.log(
            "No se encontró el código del producto en la URL."
        );

        return;
    }

    fetch(
        "obtenerproducto.php?codigo=" +
        encodeURIComponent(codigo)
    )
        .then(respuesta => {

            console.log(
                "Estado obtenerproducto.php:",
                respuesta.status
            );

            if (!respuesta.ok) {

                throw new Error(
                    "Error HTTP: " +
                    respuesta.status
                );
            }

            return respuesta.json();
        })

        .then(producto => {

            console.log(
                "Producto recibido:",
                producto
            );

            if (producto.error) {

                console.log(
                    producto.error
                );

                return;
            }

            const nombre =
                document.getElementById(
                    "nombreProducto"
                );

            if (nombre) {

                nombre.textContent =
                    producto.NombreProducto;
            }

            const precio =
                document.getElementById(
                    "precioProducto"
                );

            if (precio) {

                precio.textContent =
                    "Bs. " +
                    producto.PrecioProducto;
            }

            const descripcion =
                document.getElementById(
                    "descripcionProducto"
                );

            if (descripcion) {

                descripcion.textContent =
                    producto.DetalleProducto;
            }

            const miniaturas =
                document.getElementById(
                    "miniaturas"
                );

            const imagenPrincipal =
                document.getElementById(
                    "imagenPrincipal"
                );

            if (!miniaturas) {

                console.log(
                    "No existe #miniaturas"
                );

                return;
            }

            miniaturas.innerHTML = "";

            if (
                producto.imagenes &&
                producto.imagenes.length > 0
            ) {

                if (imagenPrincipal) {

                    imagenPrincipal.src =
                        "../Productos/imagenes/" +
                        producto.imagenes[0];

                    imagenPrincipal.alt =
                        producto.NombreProducto;
                }

                producto.imagenes.forEach(imagen => {

                    const miniatura =
                        document.createElement("img");

                    miniatura.src =
                        "../Productos/imagenes/" +
                        imagen;

                    miniatura.alt =
                        producto.NombreProducto;

                    miniatura.addEventListener(
                        "click",
                        function () {

                            cambiarImagen(this);

                        }
                    );

                    miniaturas.appendChild(
                        miniatura
                    );

                });

            } else {

                console.log(
                    "El producto no tiene imágenes."
                );
            }

            configurarCantidad();

            configurarCarrito(
                codigo,
                idPedido
            );

        })

        .catch(error => {

            console.log(
                "Error al cargar producto:",
                error
            );

        });
}


function cambiarImagen(imagen) {

    const imagenPrincipal =
        document.getElementById(
            "imagenPrincipal"
        );

    if (imagenPrincipal) {

        imagenPrincipal.src =
            imagen.src;
    }
}


function configurarCantidad() {

    const botonMenos =
        document.getElementById(
            "btnMenos"
        );

    const botonMas =
        document.getElementById(
            "btnMas"
        );

    const cantidad =
        document.getElementById(
            "cantidadProducto"
        );

    if (!botonMenos || !botonMas || !cantidad) {

        return;
    }

    let valor = 1;

    botonMenos.addEventListener(
        "click",
        function () {

            if (valor > 1) {

                valor--;

                cantidad.textContent =
                    valor;
            }

        }
    );

    botonMas.addEventListener(
        "click",
        function () {

            valor++;

            cantidad.textContent =
                valor;
        }
    );
}


function configurarCarrito(
    codigo,
    idPedido
) {

    const boton =
        document.getElementById(
            "botonCarrito"
        );

    if (!boton) {

        return;
    }

    boton.addEventListener(
        "click",
        function (evento) {

            evento.preventDefault();

            const cantidad =
                document.getElementById(
                    "cantidadProducto"
                );

            const cantidadSeleccionada =
                cantidad
                    ? cantidad.textContent
                    : 1;

            let url =
                "../Pedidos/crearpedido.php" +
                "?Codigo=" +
                encodeURIComponent(codigo) +
                "&Cantidad=" +
                encodeURIComponent(
                    cantidadSeleccionada
                );

            if (idPedido) {

                url +=
                    "&idPedido=" +
                    encodeURIComponent(
                        idPedido
                    );
            }

            window.location.href =
                url;

        }
    );
}


document.addEventListener(
    "DOMContentLoaded",
    function () {

        cargarProducto();

    }
);
