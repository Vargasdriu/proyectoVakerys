let productoActual = null;

const parametros = new URLSearchParams(window.location.search);
const codigoProducto = parametros.get("Codigo");
const idPedido = parametros.get("idPedido");

document.addEventListener("DOMContentLoaded", function () {

    cargarProducto();

    const botonMenos = document.getElementById("btnMenos");
    const botonMas = document.getElementById("btnMas");
    const cantidadElemento = document.getElementById("cantidadProducto");
    const botonAgregar = document.getElementById("botonCarrito");

    if (botonMenos && cantidadElemento) {

        botonMenos.addEventListener("click", function () {

            let cantidad =
                parseInt(cantidadElemento.textContent) || 1;

            if (cantidad > 1) {
                cantidad--;
                cantidadElemento.textContent = cantidad;
            }

        });

    }

    if (botonMas && cantidadElemento) {

        botonMas.addEventListener("click", function () {

            if (!productoActual) {

                Swal.fire({
                    icon: "warning",
                    title: "Producto no disponible",
                    text: "Espera a que cargue el producto."
                });

                return;
            }

            let cantidad =
                parseInt(cantidadElemento.textContent) || 1;

            const stock =
                parseInt(productoActual.Stock) || 0;

            if (cantidad < stock) {

                cantidad++;
                cantidadElemento.textContent = cantidad;

            } else {

                Swal.fire({
                    icon: "warning",
                    title: "Stock insuficiente",
                    text: "No puedes agregar más unidades de las disponibles."
                });

            }

        });

    }

    if (botonAgregar) {

        botonAgregar.addEventListener("click", function () {
            agregarAlCarrito();
        });

    }

});


function cargarProducto() {

    if (!codigoProducto) {

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se encontró el código del producto."
        });

        return;
    }

    fetch("obtenerproductos.php")

        .then(respuesta => {

            if (!respuesta.ok) {
                throw new Error("Error al cargar los productos.");
            }

            return respuesta.json();

        })

        .then(productos => {

            productoActual = productos.find(
                producto =>
                    String(producto.Codigo) === String(codigoProducto)
            );

            if (!productoActual) {

                Swal.fire({
                    icon: "error",
                    title: "Producto no encontrado",
                    text: "No se encontró la información del producto."
                });

                return;
            }

            const nombreProducto =
                document.getElementById("nombreProducto");

            const precioProducto =
                document.getElementById("precioProducto");

            const descripcionProducto =
                document.getElementById("descripcionProducto");

            if (nombreProducto) {

                nombreProducto.textContent =
                    productoActual.NombreProducto;

            }

            if (precioProducto) {

                precioProducto.textContent =
                    "Bs. " +
                    Number(productoActual.PrecioProducto).toFixed(2);

            }

            if (descripcionProducto) {

                descripcionProducto.textContent =
                    productoActual.DetalleProducto;

            }

            const imagenPrincipal =
                document.getElementById("imagenPrincipal");

            const miniaturas =
                document.getElementById("miniaturas");

            const imagenes =
                productoActual.Imagenes || [];

            if (imagenes.length === 0 && productoActual.Imagen) {
                imagenes.push(productoActual.Imagen);
            }

            if (imagenes.length > 0 && imagenPrincipal) {

                imagenPrincipal.src =
                    "../Productos/imagenes/" + imagenes[0];

                imagenPrincipal.alt =
                    productoActual.NombreProducto;

            }

            if (miniaturas) {

                miniaturas.innerHTML = "";

                imagenes.forEach(function (imagen, indice) {

                    const miniatura =
                        document.createElement("img");

                    miniatura.src =
                        "../Productos/imagenes/" + imagen;

                    miniatura.alt =
                        productoActual.NombreProducto;

                    miniatura.classList.add("miniatura");

                    if (indice === 0) {
                        miniatura.classList.add("activa");
                    }

                    miniatura.addEventListener("click", function () {

                        if (imagenPrincipal) {
                            imagenPrincipal.src = this.src;
                        }

                        miniaturas
                            .querySelectorAll(".miniatura")
                            .forEach(function (img) {
                                img.classList.remove("activa");
                            });

                        this.classList.add("activa");

                    });

                    miniaturas.appendChild(miniatura);

                });

            }

        })

        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo cargar la información del producto."
            });

        });

}


function agregarAlCarrito() {

    if (!productoActual) {

        Swal.fire({
            icon: "warning",
            title: "Producto no disponible",
            text: "Espera a que cargue el producto."
        });

        return;
    }

    if (!idPedido) {

        Swal.fire({
            icon: "warning",
            title: "¡Primero crea tu pedido!",
            text: "No se encontró el pedido actual."
        });

        return;
    }

    const cantidadElemento =
        document.getElementById("cantidadProducto");

    if (!cantidadElemento) {

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se encontró la cantidad del producto."
        });

        return;
    }

    const cantidad =
        parseInt(cantidadElemento.textContent) || 1;

    const stock =
        parseInt(productoActual.Stock) || 0;

    if (stock <= 0) {

        Swal.fire({
            icon: "warning",
            title: "Producto agotado",
            text: "Este producto no tiene stock disponible."
        });

        return;
    }

    if (cantidad > stock) {

        Swal.fire({
            icon: "warning",
            title: "Stock insuficiente",
            text: "No puedes agregar esa cantidad."
        });

        return;
    }

    const datos = new URLSearchParams();

    datos.append("accion", "agregar");
    datos.append("codigo", productoActual.Codigo);
    datos.append("cantidad", cantidad);
    datos.append("idPedido", idPedido);

    console.log("Enviando:", datos.toString());

    fetch("carrito.php", {

        method: "POST",

        headers: {
            "Content-Type":
                "application/x-www-form-urlencoded"
        },

        body: datos.toString()

    })

    .then(respuesta => {

        if (!respuesta.ok) {
            throw new Error(
                "Error HTTP: " + respuesta.status
            );
        }

        return respuesta.text();

    })

    .then(texto => {

        console.log("Respuesta carrito.php:", texto);

        Swal.fire({
            icon: "success",
            title: "Producto añadido",
            text: "El producto se añadió correctamente al carrito.",
            timer: 1800,
            showConfirmButton: false
        });

        cantidadElemento.textContent = "1";

        if (typeof actualizarCarrito === "function") {
            actualizarCarrito();
        }

    })

    .catch(error => {

        console.error(error);

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo agregar el producto al carrito."
        });

    });

}
