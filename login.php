<?php

require 'include/config/database.php';
$db = conectarDB();

//Autenticar
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }

    if (!$password) {
        $errores = "El password es obligatorio";
    }

    if (empty($errores)) {
        //revisar si el usuario existe
        $query = "SELECT * FROM usuario WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            //revisar si la contraseña es correcta
            $usuario = mysqli_fetch_assoc($resultado);
            //verificaion de la contraseña
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {

            } else {
                $errores[] = 'La contraseña es incorrecta';
            }

        } else {
            $errores[] = "El usuario no existe";
        }
    }
}


//Incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Correo y Contraseña</legend>

            <label for="email">Correo</label>
            <input type="email" name="email" placeholder="Tu correo" id="email">

            <label for="Password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>