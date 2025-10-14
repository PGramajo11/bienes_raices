<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad"
        value="<?php echo htmlspecialchars($propiedad->titulo ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" step="0.01" min="0"
        value="<?php echo htmlspecialchars($propiedad->precio ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php
    echo htmlspecialchars($propiedad->descripcion ?? '', ENT_QUOTES, 'UTF-8');
    ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="0" max="99"
        value="<?php echo htmlspecialchars($propiedad->habitaciones ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 1" min="0" max="99"
        value="<?php echo htmlspecialchars($propiedad->wc ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 2" min="0" max="99"
        value="<?php echo htmlspecialchars($propiedad->estacionamiento ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor_id">Vendedor:</label>
    <select name="propiedad[vendedor_id]" id="vendedor_id">
        <option selected value="">-- Seleccione -- </option>
        <?php foreach ($vendedores as $vendedor) { ?>
            <option <?php echo $propiedad->vendedor_id === $vendedor->id ? 'selected' : ''; ?>
                value="<?php echo htmlspecialchars($vendedor->id ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($vendedor->nombre ?? '', ENT_QUOTES, 'UTF-8') . " " . s($vendedor->apellido); ?>
            </option>
        <?php } ?>
    </select>
</fieldset>