<?php

require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

//validar que sea un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

//obtener al vendedor de la BD
$vendedor = Vendedor::find($id);

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //asignar nuevos valores
    $args = $_POST['vendedor'];

    $vendedor->sincronizar($args);

    //validar nuevos campos
    $errores = $vendedor->validar();

    //guardar
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>