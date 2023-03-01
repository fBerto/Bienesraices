<?php  
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false; //operador de fusión de nulos


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="http://localhost/Bienesraices/index.php   
                ">
                    <img src="/Bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/Bienesraices/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/Bienesraices/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="http://localhost/Bienesraices/nosotros.php">Nosotros</a>
                        <a href="http://localhost/Bienesraices/anuncios.php">Anuncios</a>
                        <a href="http://localhost/Bienesraices/blog.php">Blog</a>
                        <a href="http://localhost/Bienesraices/contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="http://localhost/Bienesraices/cerrar-sesion.php">Cerrar Session</a>
                        <?php endif; ?>   
                    </nav>
                </div>
            </div> <!--.barra-->
            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>