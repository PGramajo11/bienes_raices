<?php
declare(strict_types=1);

use Domain\Propiedades\PropiedadValidator;

final class PropiedadValidatorTest extends TestCase
{
    public function test_valida_datos_correctos(): void
    {
        $data = [
            'titulo' => 'Casa moderna zona 10',
            'precio' => '250000',
            'imagen' => 'fachada.jpg',
            'descripcion' => str_repeat('Excelente ubicación y acabados. ', 3), // 80+ chars
            'habitaciones' => 3,
            'wc' => 2,
            'estacionamiento' => 1,
            'vendedor_id' => 1,
        ];

        $out = PropiedadValidator::validar($data);

        $this->assertSame('Casa moderna zona 10', $out['titulo']);
        $this->assertSame(250000.00, $out['precio']);
        $this->assertSame('fachada.jpg', $out['imagen']);
        $this->assertGreaterThanOrEqual(60, strlen($out['descripcion']));
        $this->assertSame(3, $out['habitaciones']);
        $this->assertSame(2, $out['wc']);
        $this->assertSame(1, $out['estacionamiento']);
        $this->assertSame(1, $out['vendedor_id']);
    }

    public function test_rechaza_descripcion_corta(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        PropiedadValidator::validar([
            'titulo' => 'Casa',
            'precio' => 50000,
            'descripcion' => 'Muy corta',
        ]);
    }

    public function test_rechaza_imagen_con_extension_invalida(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        PropiedadValidator::validar([
            'titulo' => 'Casa',
            'precio' => 50000,
            'descripcion' => str_repeat('Texto largo ', 6),
            'imagen' => 'archivo.exe',
        ]);
    }

    public function test_rechaza_valores_negativos_en_habitaciones_wc_estacionamiento(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        PropiedadValidator::validar([
            'titulo' => 'Casa',
            'precio' => 50000,
            'descripcion' => str_repeat('Texto largo ', 6),
            'habitaciones' => -2,
            'wc' => -1,
            'estacionamiento' => -3,
        ]);
    }

    public function test_rechaza_vendedor_id_invalido(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        PropiedadValidator::validar([
            'titulo' => 'Casa',
            'precio' => 10000,
            'descripcion' => str_repeat('Texto largo ', 6),
            'vendedor_id' => 0,
        ]);
    }
}
