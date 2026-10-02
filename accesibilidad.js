document.addEventListener("DOMContentLoaded", function(){

    if(document.body.classList.contains("voz-activa")){

        const contenido = document.querySelector("main");

        if(contenido && "speechSynthesis" in window){

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

            if(texto.trim() !== ""){

                const mensaje = new SpeechSynthesisUtterance(texto);

                mensaje.lang = "es-ES";
                mensaje.rate = 0.9;
                mensaje.pitch = 1;
                mensaje.volume = 1;

                speechSynthesis.speak(mensaje);

            }

        }

    }

    document.addEventListener("keydown", function(event){

        if(event.key === "Escape" && "speechSynthesis" in window){
            speechSynthesis.cancel();
        }

    });

});