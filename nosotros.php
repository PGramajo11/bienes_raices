<?php

require 'includes/app.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at placerat nulla. Suspendisse
                volutpat massa non nunc placerat vulputate. Quisque eros lorem, pretium ut tempus non, suscipit sed
                magna. Aliquam erat volutpat. Morbi neque eros, posuere vitae lacus quis, vehicula malesuada massa.
                Maecenas tortor lectus, placerat id convallis eu, accumsan ac urna. Suspendisse blandit augue
                molestie vestibulum placerat. In sed luctus felis. Nam at tellus non orci feugiat condimentum ut eu
                turpis.</p>

            <p>Donec varius eu urna sit amet facilisis. Fusce nisi ex, efficitur sit amet mollis ultrices, ornare
                sit amet velit. Sed rhoncus neque eget diam sollicitudin placerat. Pellentesque ut mauris eget
                mauris dapibus facilisis eu eu arcu. In fermentum tristique nisl, ut auctor elit malesuada vel. In
                scelerisque porta aliquam.</p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu risus ut nunc semper dapibus. Nulla
                vel
                lorem sit amet ligula tincidunt gravida.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu risus ut nunc semper dapibus. Nulla
                vel
                lorem sit amet ligula tincidunt gravida.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu risus ut nunc semper dapibus. Nulla
                vel
                lorem sit amet ligula tincidunt gravida. </p>
        </div>
    </div>
</section>

<?php
incluirTemplate('footer');
?>