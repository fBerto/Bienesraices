<?php
require "includes/funciones.php";
incluirTemplate("header");
?>
<main class="contenedor seccion">
  <h1>Conoce sobre Nosotros</h1>
  <div class="contenido-nosotros">
    <div class="imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros" />
      </picture>
    </div>
    <div class="texto-nosotros">
      <blockquote>25 Años de experiencia</blockquote>
      <p>
        Proin consequat viverra sapien, malesuada tempor tortor feugiat
        vitae. cumsan maximus est, eu mollis mi.
        Proin id nisl vel odio semper hendrerit. Nunc porta in justo finibus
        tempor. SuspeDonec et imperdiet augue. Curabitur
        malesuada sodales congue. Suspendisse potenti. Ut sit amet convallis
        nisi.
      </p>
      <p>
        Aliquam lectus magna, luctus vel gravida nec, iaculis ut augue.
        Praesent ac enim lorem. Quisque ac dignissim sem, non condimentum
        orci. Morbi a iaculis neque, ac euismod felis. Fusce augue quam,
        fermentum sed turpis nec, hendrerit dapibus ante. Cras mattis
        laoreet nibh, quis tincidunt odio fermentum vel. Nulla facilisi.
      </p>
    </div>
  </div>
</main>

<section class="contenedor seccion">
  <h1>Mas Sobre Nosotros</h1>
  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
        voluptates quo itaque dicta suscipit eaque officiis, amet nihil aut
        ad omnis eius. Dolorem fuga nesciunt voluptatum nisi natus labore
        nihil?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
        voluptates quo itaque dicta suscipit eaque officiis, amet nihil aut
        ad omnis eius. Dolorem fuga nesciunt voluptatum nisi natus labore
        nihil?
      </p>
    </div>
    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono A tiempo" loading="lazy" />
      <h3>A Tiempo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
        voluptates quo itaque dicta suscipit eaque officiis, amet nihil aut
        ad omnis eius. Dolorem fuga nesciunt voluptatum nisi natus labore
        nihil?
      </p>
    </div>
  </div>
</section>
<?php
incluirTemplate("footer");
?>