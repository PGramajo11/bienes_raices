<?php include 'includes/templates/header.php'; ?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta frente la bosque</h1>

    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img src="build/img/destacada.jpg" alt="imagne de la propiedad" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">Q7,000,000</p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy">
                <p>4</p>
            </li>
        </ul>

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


</main>

<?php

include 'includes/templates/footer.php';
?>