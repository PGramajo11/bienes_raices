<?php
declare(strict_types=1);

namespace Domain\Propiedades;

final class PropiedadValidator
{
    private const IMG_EXT_PERMITIDAS = ['jpg', 'jpeg', 'png', 'webp'];

    /**
     * Valida los datos de una propiedad según la estructura real de la BD.
     * @throws \InvalidArgumentException
     */
    public static function validar(array $data): array
    {
        // Título: requerido, mínimo 3 caracteres
        $titulo = trim((string) ($data['titulo'] ?? ''));
        if ($titulo === '' || mb_strlen($titulo) < 3) {
            throw new \InvalidArgumentException('El título es obligatorio y debe tener al menos 3 caracteres.');
        }

        // Precio: numérico y mayor que 0
        if (!isset($data['precio']) || !is_numeric($data['precio'])) {
            throw new \InvalidArgumentException('El precio es obligatorio y debe ser numérico.');
        }
        $precio = (float) $data['precio'];
        if ($precio <= 0) {
            throw new \InvalidArgumentException('El precio debe ser mayor a 0.');
        }

        // Descripción: requerida, mínimo 60 caracteres
        $descripcion = trim((string) ($data['descripcion'] ?? ''));
        if (mb_strlen($descripcion) < 60) {
            throw new \InvalidArgumentException('La descripción debe contener al menos 60 caracteres.');
        }

        // Imagen: opcional pero si existe debe tener extensión válida
        $imagen = isset($data['imagen']) ? (string) $data['imagen'] : null;
        if ($imagen) {
            $ext = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
            if (!in_array($ext, self::IMG_EXT_PERMITIDAS, true)) {
                throw new \InvalidArgumentException('Formato de imagen no permitido (jpg, jpeg, png, webp).');
            }
        }

        // Habitaciones
        $habitaciones = (int) ($data['habitaciones'] ?? 0);
        if ($habitaciones < 0) {
            throw new \InvalidArgumentException('El número de habitaciones no puede ser negativo.');
        }

        // Baños (wc)
        $wc = (int) ($data['wc'] ?? 0);
        if ($wc < 0) {
            throw new \InvalidArgumentException('El número de baños (wc) no puede ser negativo.');
        }

        // Estacionamientos
        $estacionamiento = (int) ($data['estacionamiento'] ?? 0);
        if ($estacionamiento < 0) {
            throw new \InvalidArgumentException('El número de estacionamientos no puede ser negativo.');
        }

        // Vendedor_id: opcional pero si existe debe ser numérico
        // Vendedor_id: OBLIGATORIO y ≥ 1
        if (!isset($data['vendedor_id']) || !is_numeric($data['vendedor_id']) || (int) $data['vendedor_id'] < 1) {
            throw new \InvalidArgumentException('El vendedor_id es obligatorio y debe ser un entero válido (≥ 1).');
        }
        $vendedor_id = (int) $data['vendedor_id'];


        return [
            'titulo' => $titulo,
            'precio' => round($precio, 2),
            'imagen' => $imagen,
            'descripcion' => $descripcion,
            'habitaciones' => $habitaciones,
            'wc' => $wc,
            'estacionamiento' => $estacionamiento,
            'vendedor_id' => $vendedor_id,
            // El campo 'creado' lo asigna la BD o el sistema (no se valida aquí)
        ];
    }
}

