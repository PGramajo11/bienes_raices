<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor o Vendedora"
        value="<?php echo htmlspecialchars($vendedor->nombre ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del Vendedor o Vendedora"
        value="<?php echo htmlspecialchars($vendedor->apellido ?? '', ENT_QUOTES, 'UTF-8'); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono del Vendedor o Vendedora"
        value="<?php echo htmlspecialchars($vendedor->telefono ?? '', ENT_QUOTES, 'UTF-8'); ?>">

</fieldset>