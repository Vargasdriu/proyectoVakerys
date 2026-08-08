function mostrarProductos() {

    fetch("obtenerProductos.php")
        .then(respuesta => respuesta.json())
        .then(productos => {

            let contenedor = document.getElementById("productos");

            contenedor.innerHTML = "";

            productos.forEach(producto => {

                contenedor.innerHTML += `

                    <div class="proc" onclick="verProducto('${producto.Codigo}')">

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

                                <button>-</button>

                                <span>1</span>

                                <button>+</button>

                            </div>

                            <div class="anadir">

                                <img 
                                    class="carro"
                                    src="../imagenes/anadir-al-carrito.png"
                                    alt=""
                                >

                                <p>Añadir</p>

                            </div>

                        </div>

                    </div>

                `;

            });

        })
        .catch(error => {

            console.log("Error al cargar productos:", error);

        });

}


function verProducto(codigo) {

    window.location.href =
        "producto.php?codigo=" + codigo;

}


mostrarProductos();