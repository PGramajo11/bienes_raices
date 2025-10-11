<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

//autenticar usuario
estaAutenticado();

$db = conectarDB();

//consultar los vendedores
$consulta = "SELECT * FROM vendedor";
$resultado = mysqli_query($db, $consulta);

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedor_id = '';

//arreglo con los mensajes de errores
$errores = Propiedad::getErrores();

//ejecutar el código despues que el usaurio envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    //generar nombre unico a la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    if ($_FILES['imagen']['tmp_name']) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    //revisar el arreglo de errores que este vacio
    if (empty($errores)) {

        //subida de archivos
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        //Guardar la imagen en el servidor
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardar();

        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad"
                value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">descripció:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $titulo; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9"
                value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 1" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 2" min="1" max="9"
                value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor_id">
                <option value="">-- Seleccionar Vendedor --</option>
                <?php while ($vendedor_id = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedor_id === $vendedor_id['id'] ? 'selected' : ''; ?>
                        value="<?php echo $vendedor_id['id']; ?>">
                        <?php echo $vendedor_id['nombre'] . " " . $vendedor_id['apellido']; ?>
                    </option>

                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>