document.addEventListener("DOMContentLoaded", function(){

    const botonEscuchar = document.getElementById("escuchar");

    if(botonEscuchar){

        botonEscuchar.addEventListener("click", function(){

            if(!("speechSynthesis" in window)){

                alert("La función de lectura por voz no está disponible en este navegador.");

                return;
            }

            speechSynthesis.cancel();

            const contenido = document.querySelector("main");

            if(!contenido){
                return;
            }

            const elementos = contenido.querySelectorAll(
                "h1, h2, h3, p, label, strong, li"
            );

            let texto = "";

            elementos.forEach(function(elemento){

                const contenidoTexto = elemento.innerText.trim();

                if(contenidoTexto !== ""){
                    texto += contenidoTexto + ". ";
                }

            });

            if(texto.trim() === ""){

                alert("No hay información disponible para leer.");

                return;
            }

            const mensaje = new SpeechSynthesisUtterance(texto);

            mensaje.lang = "es-ES";
            mensaje.rate = 0.9;
            mensaje.pitch = 1;
            mensaje.volume = 1;

            speechSynthesis.speak(mensaje);

        });

    }

    document.addEventListener("keydown", function(event){

        if(event.key === "Escape"){
            speechSynthesis.cancel();
        }

    });

});