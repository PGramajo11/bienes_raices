<?php

$resultado = $_GET['resultado'] ?? null;
require '../includes/funciones.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador</h1>

    <?php if (intval($resultado) === 1): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Casa en la playa</td>
                <td> <img src="/imagenes/35b83da34ba84ae4b34ca465edf2d093.jpg" class="imagen-tabla"> </td>
                <td>Q1,000,000.00</td>
                <td>
                    <a href="#" class="boton-rojo">Eliminar</a>
                    <a href="#" class="boton-amarillo">Actualizar</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');
?>