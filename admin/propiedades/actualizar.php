<?php
//Validar que sea un ID 
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header("Location:/bienesraices/admin/index.php");
}

require "../../includes/config/database.php";
$db = conectarBD();

//Consulta para obtener datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
//Como solo necesito un registro, lo asigno y dsp no voy a tener problemas q se sobreescriba
$propiedad = mysqli_fetch_assoc($resultado);

//Consultar para obtener valores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Mensajes de errores
$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedores_id = $propiedad["vendedores_id"];
$creado = $propiedad["creado"];
$imagenPropiedad = $propiedad["imagen"];

//Ejecutar el codigo dsp de q el usuario envia el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Asignar variables
    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedores_id = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date("Y/m/d");

    //Asignar files hacia una variable
    $imagen = $_FILES["imagen"];


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

    $medida = 1000 * 1000; //1M max
    if ($imagen["size"] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    if (empty($errores)) {
        //Crear carpeta
        $carpetaImagenes = "../../imagenes/";
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = "";

        if ($imagen["name"]) {
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";//Generar un nombre unico
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
            unlink($carpetaImagenes . $propiedad["imagen"]);
        } else {
            $nombreImagen = $propiedad["imagen"];
        }


        //Insertar en la BD
        $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, 
        wc = {$wc}, estacionamiento = {$estacionamiento}, vendedores_id = {$vendedores_id} WHERE id ={$id}";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //Redireccionar al usuario
            header("Location:/bienesraices/admin/index.php?resultado=2");
        }
    }
}

require "../../includes/funciones.php";
incluirTemplate("header");
?>


<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php  }
    ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" placeholder="Titulo Propiedad" id="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="text" name="precio" placeholder="Precio Propiedad" id="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpg, image/png" name="imagen">

            <img src="/bienesraices/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>