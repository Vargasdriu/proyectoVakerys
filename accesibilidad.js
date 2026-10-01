document.addEventListener("DOMContentLoaded", function(){

    if(localStorage.getItem("textoGrande") === "true"){
        document.body.classList.add("texto-grande");
    }

    if(localStorage.getItem("altoContraste") === "true"){
        document.body.classList.add("alto-contraste");
    }

    if(localStorage.getItem("navegacionTeclado") === "true"){
        document.body.classList.add("navegacion-teclado");
    }

});