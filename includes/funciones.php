<?php
define("TEMPLATES_URL",__DIR__."/templates"); //tenemos que entrar a la carpeta
define("FUNCIONES_URL",__DIR__.".funciones.php"); //estan en el mismo nivel 
//dir para tomar la ubicacion del archivo actual 


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado(): void
{
    session_start(); 
    if (!$_SESSION['login']) {
        header('Location:/Bienesraices/index.php');
    }
}

function debugear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}