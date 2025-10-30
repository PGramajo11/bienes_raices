<?php
declare(strict_types=1);

use Services\PropiedadService;
use Repositories\IPropiedadRepository;

final class FakePropiedadRepo implements IPropiedadRepository
{
    public array $ultimoPayload = [];
    public int $idADevolver = 101;

    public function save(array $data): int
    {
        $this->ultimoPayload = $data;
        return $this->idADevolver;
    }
}

final class PropiedadServiceTest extends TestCase
{
    public function test_crear_llama_repo_con_datos_validados_y_devuelve_id(): void
    {
        $repo = new FakePropiedadRepo();
        $service = new PropiedadService($repo);

        $id = $service->crear([
            'titulo' => 'Apartamento zona 15',
            'precio' => 150000,
            'descripcion' => str_repeat('Apartamento de lujo con buena vista. ', 3),
            'imagen' => 'plano.png',
            'habitaciones' => 2,
            'wc' => 2,
            'estacionamiento' => 1,
            'vendedor_id' => 2,
        ]);

        $this->assertSame(101, $id);
        $this->assertSame('Apartamento zona 15', $repo->ultimoPayload['titulo']);
        $this->assertSame(150000.00, $repo->ultimoPayload['precio']);
        $this->assertSame('plano.png', $repo->ultimoPayload['imagen']);
        $this->assertSame(2, $repo->ultimoPayload['habitaciones']);
    }

    public function test_crear_falla_si_repo_devuelve_id_invalido(): void
    {
        $repo = new FakePropiedadRepo();
        $repo->idADevolver = 0; // simulamos fallo del repositorio
        $service = new \Services\PropiedadService($repo);

        // Debemos pasar todas las validaciones (incluye vendedor_id y descripción ≥ 60)
        $this->expectException(\RuntimeException::class);
        $service->crear([
            'titulo' => 'Casa válida',
            'precio' => 90000,
            'descripcion' => str_repeat('Descripción suficientemente larga para validar correctamente. ', 2),
            'imagen' => 'foto.jpg',
            'habitaciones' => 2,
            'wc' => 1,
            'estacionamiento' => 1,
            'vendedor_id' => 1, // ← requerido por el validador y tu BD
        ]);
    }


    public function test_crear_lanza_excepcion_por_datos_invalidos(): void
    {
        $repo = new FakePropiedadRepo();
        $service = new PropiedadService($repo);

        $this->expectException(\InvalidArgumentException::class);
        $service->crear([
            'titulo' => 'Ca', // muy corto
            'precio' => 50000,
            'descripcion' => str_repeat('Texto largo ', 6),
        ]);
    }
}
