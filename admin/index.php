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

        $tipo = $_POST['tipo'];

        if ($tipo === 'vendedor') {
            $vendedor = Vendedor::find($id);
            $vendedor->eliminar();
        } else if ($tipo === 'propiedad') {
            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
        }
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

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Crear Vendedor</a>

    <h2>Propiedades</h2>
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
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propieda->id; ?>"
                            class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td>+502 <?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="id" value="<?php echo $propieda->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="admin/vendedores/actualizar.php?id=<?php echo $propieda->id; ?>"
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