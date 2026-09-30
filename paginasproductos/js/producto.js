let productoActual = null;

const parametros = new URLSearchParams(window.location.search);
const codigoProducto = parametros.get("Codigo");
const idPedido = parametros.get("idPedido");

document.addEventListener("DOMContentLoaded", function () {
    cargarProducto();

    const botonMenos = document.getElementById("btnMenos");
    const botonMas = document.getElementById("btnMas");
    const cantidadInput = document.getElementById("cantidad");

    if (botonMenos && cantidadInput) {
        botonMenos.addEventListener("click", function () {
            let cantidad = parseInt(cantidadInput.value) || 1;

            if (cantidad > 1) {
                cantidad--;
                cantidadInput.value = cantidad;
            }
        });
    }

    if (botonMas && cantidadInput) {
        botonMas.addEventListener("click", function () {
            let cantidad = parseInt(cantidadInput.value) || 1;

            if (productoActual) {
                const stock = parseInt(productoActual.Stock) || 0;

                if (cantidad < stock) {
                    cantidad++;
                    cantidadInput.value = cantidad;
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Stock insuficiente",
                        text: "No puedes agregar más unidades de las disponibles."
                    });
                }
            }
        });
    }

    const botonAgregar = document.getElementById("agregarCarrito");

    if (botonAgregar) {
        botonAgregar.addEventListener("click", agregarAlCarrito);
    }
});


function cargarProducto() {

    if (!codigoProducto) {
        console.error("No se encontró el código del producto.");
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
                console.error("Producto no encontrado.");
                return;
            }

            document.getElementById("nombreProducto").textContent =
                productoActual.NombreProducto;

            document.getElementById("precioProducto").textContent =
                "Bs. " +
                Number(productoActual.PrecioProducto).toFixed(2);

            document.getElementById("descripcionProducto").textContent =
                productoActual.DetalleProducto;

            const imagenPrincipal =
                document.getElementById("imagenPrincipal");

            const miniaturas =
                document.getElementById("miniaturas");

            const imagenes = productoActual.Imagenes || [];

            if (imagenes.length === 0 && productoActual.Imagen) {
                imagenes.push(productoActual.Imagen);
            }

            if (imagenes.length > 0) {

                imagenPrincipal.src =
                    "../Productos/imagenes/" + imagenes[0];

                imagenPrincipal.alt =
                    productoActual.NombreProducto;
            }

            miniaturas.innerHTML = "";

            imagenes.forEach(function (imagen, indice) {

                const miniatura = document.createElement("img");

                miniatura.src =
                    "../Productos/imagenes/" + imagen;

                miniatura.alt =
                    productoActual.NombreProducto;

                miniatura.classList.add("miniatura");

                if (indice === 0) {
                    miniatura.classList.add("activa");
                }

                miniatura.addEventListener("click", function () {

                    imagenPrincipal.src = this.src;

                    miniaturas
                        .querySelectorAll(".miniatura")
                        .forEach(function (img) {
                            img.classList.remove("activa");
                        });

                    this.classList.add("activa");
                });

                miniaturas.appendChild(miniatura);
            });
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

    const cantidadInput =
        document.getElementById("cantidad");

    const cantidad =
        parseInt(cantidadInput.value) || 1;

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
                throw new Error("Error en la solicitud.");
            }

            return respuesta.json();
        })
        .then(resultado => {

            if (resultado.success) {

                Swal.fire({
                    icon: "success",
                    title: "Producto agregado",
                    text: "El producto fue agregado al carrito.",
                    timer: 1500,
                    showConfirmButton: false
                });

                cantidadInput.value = 1;

                if (typeof actualizarCarrito === "function") {
                    actualizarCarrito();
                }

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: resultado.message ||
                        "No se pudo agregar el producto."
                });
            }
        })
        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo conectar con el servidor."
            });
        });
}