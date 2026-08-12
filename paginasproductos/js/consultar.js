/* 
document
.getElementById("consultar")
.addEventListener("click", () => {


    let id =
        document.getElementById(
            "numeroPedido"
        ).value;


    // Comprobar que se haya introducido un número
    if (id === "") {

        document.getElementById(
            "resultado"
        ).innerHTML =
            "Ingrese un número de pedido";

        return;

    }


    fetch(
        "php/consultar_pedido.php",
        {

            method: "POST",

            headers: {

                "Content-Type":
                    "application/x-www-form-urlencoded"

            },

            body:
                "id=" +
                encodeURIComponent(id)

        }
    )


    .then(respuesta =>
        respuesta.json()
    )


    .then(data => {

        console.log(
            "Respuesta:",
            data
        );


        if (data.ok) {

            let p = data.pedido;


            document.getElementById(
                "resultado"
            ).innerHTML = `

                <hr>

                <h3>
                    Pedido Nº ${p.id}
                </h3>

                <p>
                    Cliente:
                    ${p.Nombre}
                </p>

                <p>
                    Fecha:
                    ${p.Fecha}
                </p>

                <p>
                    Estado:
                    <b>${p.Estado}</b>
                </p>

                <p>
                    Vendedor:
                    ${p.NombreVendedor ?? "Pendiente"}
                </p>

                <p>
                    Teléfono:
                    ${p.telefono ?? "No registrado"}
                </p>

                <p>
                    Dirección:
                    ${p.direccion ?? "No registrada"}
                </p>

                <p>
                    Método de pago:
                    ${p.metodoPago ?? "No registrado"}
                </p>

            `;


        } else {

            document.getElementById(
                "resultado"
            ).innerHTML =
                "Pedido no encontrado";

        }

    })


    .catch(error => {

        console.log(
            "Error:",
            error
        );

        document.getElementById(
            "resultado"
        ).innerHTML =
            "Error al consultar el pedido";

    });

});
*/
