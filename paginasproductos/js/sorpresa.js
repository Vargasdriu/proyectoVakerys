document.addEventListener("DOMContentLoaded", function () {

    const btnSorprendeme = document.getElementById("btnSorprendeme");
    const modalSorpresa = document.getElementById("modalSorpresa");
    const cerrarSorpresa = document.getElementById("cerrarSorpresa");
    const otraSorpresa = document.getElementById("otraSorpresa");

    const sorpresaCargando = document.getElementById("sorpresaCargando");
    const sorpresaResultado = document.getElementById("sorpresaResultado");

    const imagenSorpresa = document.getElementById("imagenSorpresa");
    const nombreSorpresa = document.getElementById("nombreSorpresa");
    const descripcionSorpresa = document.getElementById("descripcionSorpresa");
    const precioSorpresa = document.getElementById("precioSorpresa");
    const verProductoSorpresa = document.getElementById("verProductoSorpresa");
    const agregarSorpresa = document.getElementById("agregarSorpresa");

    const imagenesCarga = document.querySelectorAll(".sorpresa-imagenes div");
    const puntosCarga = document.querySelectorAll(".sorpresa-puntos span");

    let productoSeleccionado = null;
    let intervaloCarga = null;

    function obtenerProductosDisponibles() {
        const tarjetas = document.querySelectorAll(".proc");
        const productos = [];

        tarjetas.forEach(function (tarjeta) {

            const imagen = tarjeta.querySelector(".imgb");
            const nombre = tarjeta.querySelector(".ba h1");
            const descripcion = tarjeta.querySelector(".ba p");
            const precio = tarjeta.querySelector(".precio");
            const botonAgregar = tarjeta.querySelector(".anadir");

            if (!imagen || !nombre || !precio) {
                return;
            }

            const textoTarjeta = tarjeta.innerText.toLowerCase();

            if (
                textoTarjeta.includes("agotado") ||
                tarjeta.classList.contains("agotado") ||
                tarjeta.dataset.stock === "0"
            ) {
                return;
            }

            productos.push({
                tarjeta: tarjeta,
                imagen: imagen.src,
                nombre: nombre.textContent.trim(),
                descripcion: descripcion ? descripcion.textContent.trim() : "",
                precio: precio.textContent.trim(),
                botonAgregar: botonAgregar
            });
        });

        return productos;
    }

    function mostrarModal() {
        modalSorpresa.classList.add("mostrar");

        sorpresaCargando.style.display = "block";
        sorpresaResultado.style.display = "none";

        document.body.style.overflow = "hidden";

        iniciarCarga();
    }

    function cerrarModal() {
        modalSorpresa.classList.remove("mostrar");

        document.body.style.overflow = "";

        detenerCarga();
    }

    function iniciarCarga() {

        const productos = obtenerProductosDisponibles();

        if (productos.length === 0) {
            detenerCarga();

            sorpresaCargando.style.display = "none";
            sorpresaResultado.style.display = "block";

            nombreSorpresa.textContent = "No hay productos disponibles";
            descripcionSorpresa.textContent = "En este momento no encontramos productos disponibles para recomendarte.";
            precioSorpresa.textContent = "";
            imagenSorpresa.style.display = "none";

            verProductoSorpresa.style.display = "none";
            agregarSorpresa.style.display = "none";
            otraSorpresa.style.display = "none";

            return;
        }

        productoSeleccionado = productos[Math.floor(Math.random() * productos.length)];

        let indice = 0;

        imagenesCarga.forEach(function (elemento, i) {
            if (productos[i]) {
                elemento.style.backgroundImage = "url('" + productos[i].imagen + "')";
                elemento.style.backgroundSize = "cover";
                elemento.style.backgroundPosition = "center";
            }
        });

        puntosCarga.forEach(function (punto, i) {
            punto.classList.toggle("activo", i === 0);
        });

        intervaloCarga = setInterval(function () {

            indice++;

            if (indice >= productos.length) {
                indice = 0;
            }

            const productoAnimado = productos[indice];

            if (productoAnimado) {
                const posicion = indice % imagenesCarga.length;

                imagenesCarga[posicion].style.backgroundImage =
                    "url('" + productoAnimado.imagen + "')";

                imagenesCarga[posicion].style.backgroundSize = "cover";
                imagenesCarga[posicion].style.backgroundPosition = "center";
            }

            puntosCarga.forEach(function (punto, i) {
                punto.classList.toggle(
                    "activo",
                    i === indice % puntosCarga.length
                );
            });

        }, 350);

        setTimeout(function () {
            mostrarResultado(productoSeleccionado);
        }, 1400);
    }

    function detenerCarga() {
        if (intervaloCarga) {
            clearInterval(intervaloCarga);
            intervaloCarga = null;
        }
    }

    function mostrarResultado(producto) {

        detenerCarga();

        if (!producto) {
            return;
        }

        sorpresaCargando.style.display = "none";
        sorpresaResultado.style.display = "block";

        imagenSorpresa.style.display = "block";

        verProductoSorpresa.style.display = "inline-flex";
        agregarSorpresa.style.display = "inline-flex";
        otraSorpresa.style.display = "inline-flex";

        imagenSorpresa.src = producto.imagen;
        imagenSorpresa.alt = producto.nombre;

        nombreSorpresa.textContent = producto.nombre;
        descripcionSorpresa.textContent = producto.descripcion;
        precioSorpresa.textContent = producto.precio;

        prepararEnlaceProducto(producto);
    }

    function prepararEnlaceProducto(producto) {

        let codigo = null;

        if (producto.tarjeta.dataset.codigo) {
            codigo = producto.tarjeta.dataset.codigo;
        }

        if (!codigo) {
            const enlace = producto.tarjeta.querySelector("a[href*='producto.php']");

            if (enlace) {
                const parametros = new URLSearchParams(
                    new URL(enlace.href, window.location.origin).search
                );

                codigo = parametros.get("Codigo");
            }
        }

        if (!codigo) {
            const enlaces = producto.tarjeta.querySelectorAll("a");

            enlaces.forEach(function (enlace) {

                if (codigo) {
                    return;
                }

                const href = enlace.getAttribute("href");

                if (!href) {
                    return;
                }

                if (href.includes("Codigo=")) {
                    const parametros = new URLSearchParams(
                        href.split("?")[1]
                    );

                    codigo = parametros.get("Codigo");
                }
            });
        }

        if (codigo) {
            verProductoSorpresa.href =
                "producto.php?Codigo=" + encodeURIComponent(codigo);
        } else {
            verProductoSorpresa.href = "#";

            verProductoSorpresa.onclick = function (e) {
                e.preventDefault();
                producto.tarjeta.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            };
        }
    }

    function agregarProductoSorpresa() {

        if (!productoSeleccionado) {
            return;
        }

        if (
            productoSeleccionado.botonAgregar &&
            typeof productoSeleccionado.botonAgregar.click === "function"
        ) {
            productoSeleccionado.botonAgregar.click();

            setTimeout(function () {
                cerrarModal();
            }, 500);
        } else {
            Swal.fire({
                icon: "warning",
                title: "No se pudo agregar",
                text: "No encontramos el botón para agregar este producto al carrito.",
                confirmButtonColor: "#1d3021"
            });
        }
    }

    if (btnSorprendeme) {
        btnSorprendeme.addEventListener("click", function () {
            mostrarModal();
        });
    }

    if (otraSorpresa) {
        otraSorpresa.addEventListener("click", function () {

            sorpresaCargando.style.display = "block";
            sorpresaResultado.style.display = "none";

            iniciarCarga();
        });
    }

    if (cerrarSorpresa) {
        cerrarSorpresa.addEventListener("click", function () {
            cerrarModal();
        });
    }

    if (modalSorpresa) {
        modalSorpresa.addEventListener("click", function (e) {

            if (e.target === modalSorpresa) {
                cerrarModal();
            }

        });
    }

    if (agregarSorpresa) {
        agregarSorpresa.addEventListener("click", function () {
            agregarProductoSorpresa();
        });
    }

});