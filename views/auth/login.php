<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
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