<?php

use App\Propiedad;



if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}

?>

<div class="contenedor-anuncios">
    <?php

    foreach ($propiedades as $propiedad) {

        ?>
        <div class="anuncio">

            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">


            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">Q<?php echo $propiedad->precio; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento"
                            loading="lazy">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div><!--Fin contenido-anuncio-->
        </div><!--Fin anuncio1-->
    <?php } ?>
</div><!--Fin contenido-->