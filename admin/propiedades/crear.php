<?php

require "../../includes/config/database.php";
$db = conectarBD();

//Consultar para obtener valores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Mensajes de errores
$errores = [];

$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedores_id = "";
$creado = date("Y/m/d");

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
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado ,vendedores_id) VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedores_id')";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //Redireccionar al usuario
            header("Location:/bienesraices/admin/index.php");
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
            <input type="text" name="titulo" placeholder="Titulo Propiedad" id="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="text" name="precio" placeholder="Precio Propiedad" id="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpg, image/png">

            <label for="textarea">Descripcion</label>
            <textarea id="textarea" name="descripcion"> <?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Infomracion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" placeholder="Ej: 3" id="habitaciones" name="habitaciones" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" name="wc" placeholder="Ej: 3" id="wc" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" name="estacionamiento" placeholder="Ej: 3" id="estacionamiento" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedores_id === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>