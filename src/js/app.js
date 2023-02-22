document.addEventListener("DOMContentLoaded",function(){
    
    eventListeners();
    darkMode();
});
//Dark mode
function darkMode(){
    const prefiereDarkMode =  window.matchMedia("(prefers-color-scheme: dark)");
    prefiereDarkMode.matches ? document.body.classList.add("dark-mode"): document.body.classList.remove("dark-mode")

    prefiereDarkMode.addEventListener("change", function(){
        prefiereDarkMode.matches ? document.body.classList.add("dark-mode"): document.body.classList.remove("dark-mode")
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click",function(){
        document.body.classList.toggle("dark-mode");
    });
}

//Menu Responsive
function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click",navegacionResposive);
}

function navegacionResposive(){
    const navegacion = document.querySelector (".navegacion");
    navegacion.classList.toggle("mostrar");
}


