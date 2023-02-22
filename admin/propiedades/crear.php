<?php

require "../../includes/config/database.php";
$db = conectarBD();

//Mensajes de errores
$errores = [];

//Ejecutar el codigo dsp de q el usuario envia el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo"<pre>";
    // var_dump($_POST);
    // echo"</pre>";

    //Asignar variables
    $titulo = $_POST["titulo"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $habitaciones = $_POST["habitaciones"];
    $wc = $_POST["wc"];
    $estacionamiento = $_POST["estacionamiento"];
    $vendedores_id = $_POST["vendedor"];

    if (!$titulo) {
        $errores[] = "Añadir titulo";
    }
    if (!$precio) {
        $errores[] = "Añadir precio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "Añadir descripcion y que supere 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Añadir habitaciones";
    }
    if (!$wc) {
        $errores[] = "Añadir wc";
    }
    if (!$estacionamiento) {
        $errores[] = "Añadir estacionamiento";
    }
    if (!$vendedores_id) {
        $errores[] = "Añadir vendedor";
    }

    if (empty($errores)) {
        //Insertar en la BD
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$vendedores_id')";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            echo "Bien";
        }
    }
}

require "../../includes/funciones.php";
incluirTemplate("header");
?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php  }
    ?>

    <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" placeholder="Titulo Propiedad" id="titulo">

            <label for="precio">Precio</label>
            <input type="text" name="precio" placeholder="Precio Propiedad" id="precio">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpg, image/png">

            <label for="textarea">Descripcion</label>
            <textarea id="textarea" name="descripcion"></textarea>

        </fieldset>

        <fieldset>
            <legend>Infomracion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" placeholder="Ej: 3" id="habitaciones" name="habitaciones" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" name="wc" placeholder="Ej: 3" id="wc" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" name="estacionamiento" placeholder="Ej: 3" id="estacionamiento" min="1" max="9">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="1">Franco</option>
                <option value="2">Luis</option>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>