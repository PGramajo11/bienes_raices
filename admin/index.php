<?php

//autenticar usuario
require '../includes/app.php';
estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//importar la BD
//$db = conectarDB();

//implementar metodo para obtener las propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

//muestra mensajes 
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $propiedad = Propiedad::find($id);

        $propiedad->eliminar();

    }
}


//incluir el tamplate del header
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador</h1>

    <?php if (intval($resultado) === 1): ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3): ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad +</a>

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
            <?php foreach ($propiedades as $propieda): ?>
                <tr>
                    <td><?php echo $propieda->id; ?></td>
                    <td><?php echo $propieda->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propieda->imagen; ?>" class="imagen-tabla"> </td>
                    <td>Q <?php echo $propieda->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="id" value="<?php echo $propieda->id; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propieda->id; ?>"
                            class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php

//cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');
?>