<?php

//importar la BD
require '../includes/config/database.php';
$db = conectarDB();

//Query de propiedades
$query = "SELECT * FROM propiedad";

//realizar la consulta a la BD
$resultadoConsulta = mysqli_query($db, $query);

//muestra mensajes 
$resultado = $_GET['resultado'] ?? null;
require '../includes/funciones.php';

//incluir el tamplate del header
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
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"> </td>
                    <td>Q <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="#" class="boton-rojo">Eliminar</a>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>"
                            class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php

//cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');
?>