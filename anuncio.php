<?php
$id = $_GET['id'];
$id = filter_var($id,FILTER_VALIDATE_INT);

if(!$id){
  header("Location:/bienesraices/index.php");
}

//Importar la conexion
require 'includes/config/database.php';
$db = conectarBD();
//Consultar 
$query = "SELECT * FROM propiedades WHERE id = {$id}";
//Obetener resultados
$resultadoConsulta = mysqli_query($db, $query);

if(!$resultadoConsulta -> num_rows){
  header("Location:/bienesraices/index.php");
}

$propiedad = mysqli_fetch_assoc($resultadoConsulta);

require "includes/funciones.php";
incluirTemplate("header");

?>
<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $propiedad['titulo']  ;?></h1>
  <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">
  <div class="resumen-propiedad">
    <p class="precio">$<?php echo $propiedad['precio']  ;?></p>
    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" />
        <p><?php echo $propiedad['wc']  ;?></p>
      </li>
      <li>
        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
        <p><?php echo $propiedad['estacionamiento']  ;?></p>
      </li>
      <li>
        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" />
        <p><?php echo $propiedad['habitaciones']  ;?></p>
      </li>
    </ul>
    <p><?php echo $propiedad['descripcion']  ;?></p>
  </div>
</main>   

<?php
  incluirTemplate("footer");
  //cerrar conexion
  mysqli_close($db);
?>