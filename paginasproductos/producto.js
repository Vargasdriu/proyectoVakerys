function cargarProducto() {

    const parametros = new URLSearchParams(window.location.search);

    const codigo = parametros.get("codigo");

    fetch("obtenerProducto.php?codigo=" + codigo)

        .then(respuesta => respuesta.json())

        .then(producto => {

            if (producto.error) {

                console.log(producto.error);

                return;
            }



            document.getElementById("nombreProducto").textContent =
                producto.NombreProducto;



            document.getElementById("precioProducto").textContent =
                "Bs. " + producto.PrecioProducto;



            document.getElementById("descripcionProducto").textContent =
                producto.DetalleProducto;



            const miniaturas =
                document.getElementById("miniaturas");

            miniaturas.innerHTML = "";


            if (producto.imagenes.length > 0) {

                /* IMAGEN PRINCIPAL */

                document.getElementById("imagenPrincipal").src =
                    "../Productos/" + producto.imagenes[0];



                producto.imagenes.forEach(imagen => {

                    miniaturas.innerHTML += `

                        <img
                            src="../Productos/${imagen}"
                            onclick="cambiarImagen(this)"
                            alt="${producto.NombreProducto}"
                        >

                    `;

                });

            }

        })

        .catch(error => {

            console.log("Error al cargar producto:", error);

        });

}



function cambiarImagen(imagen) {

    document.getElementById("imagenPrincipal").src =
        imagen.src;

}


/* CARGAR */

cargarProducto();