document.addEventListener("DOMContentLoaded", function(){

    if(!("speechSynthesis" in window)){
        return;
    }

    function leerPagina(){

        const contenido = document.querySelector("main");

        if(!contenido){
            return;
        }

        const elementos = contenido.querySelectorAll("h1, h2, h3, p, li, label, a");

        let texto = "";

        elementos.forEach(function(elemento){

            const contenidoTexto = elemento.innerText.trim();

            if(contenidoTexto !== ""){
                texto += contenidoTexto + ". ";
            }

        });

        if(texto.trim() === ""){
            return;
        }

        speechSynthesis.cancel();

        const mensaje = new SpeechSynthesisUtterance(texto);

        mensaje.lang = "es-ES";
        mensaje.rate = 0.9;
        mensaje.pitch = 1;
        mensaje.volume = 1;

        speechSynthesis.speak(mensaje);
    }

    if(document.body.classList.contains("voz-activa")){
        setTimeout(function(){
            leerPagina();
        }, 500);
    }

    document.addEventListener("keydown", function(event){

        if(event.key === "Escape"){
            speechSynthesis.cancel();
        }

    });

});