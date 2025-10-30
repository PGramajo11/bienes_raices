<?php
declare(strict_types=1);

use Services\PropiedadService;
use Repositories\PropiedadRepositoryPdo;

final class PropiedadCrudTest extends TestCase
{
    private PropiedadService $service;
    private PropiedadRepositoryPdo $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new PropiedadRepositoryPdo($this->pdo);
        $this->service = new PropiedadService($this->repo);
    }

    public function test_crear_propiedad_inserta_fila_y_devuelve_id(): void
    {
        $antes = $this->repo->countAll();

        $id = $this->service->crear([
            'titulo' => 'Casa en Tactic AV',
            'precio' => 200000,
            'imagen' => 'fachada.webp',
            'descripcion' => str_repeat('Propiedad amplia y segura, excelente ubicación. ', 3),
            'habitaciones' => 3,
            'wc' => 2,
            'estacionamiento' => 2,
            'vendedor_id' => 1,
        ]);

        $this->assertGreaterThan(0, $id);

        $row = $this->repo->findById($id);
        $this->assertNotNull($row);
        $this->assertSame('Casa en Tactic AV', $row['titulo']);
        $this->assertSame('200000.00', $row['precio']); // MySQL devuelve DECIMAL como string
        $this->assertSame('fachada.webp', $row['imagen']);

        $despues = $this->repo->countAll();
        $this->assertSame($antes + 1, $despues);
    }

    public function test_update_modifica_campos_persistidos(): void
    {
        // arrange: crea base
        $id = $this->service->crear([
            'titulo' => 'Casa básica',
            'precio' => 15555,
            'imagen' => null,
            'descripcion' => str_repeat('Texto de descripción suficientemente largo. ', 3),
            'habitaciones' => 2,
            'wc' => 1,
            'estacionamiento' => 1,
            'vendedor_id' => 1,
        ]);

        // act: update
        $ok = $this->repo->update($id, [
            'titulo' => 'Casa renovada',
            'precio' => 125500.75,
            'imagen' => null,
            'descripcion' => str_repeat('Descripción larga y actualizada. ', 3),
            'habitaciones' => 3,
            'wc' => 2,
            'estacionamiento' => 2,
            'vendedor_id' => 2,
        ]);
        $this->assertTrue($ok);

        // assert
        $row = $this->repo->findById($id);
        $this->assertSame('Casa renovada', $row['titulo']);
        $this->assertSame('125500.75', $row['precio']);
        $this->assertSame('3', (string) $row['habitaciones']);
        $this->assertSame('2', (string) $row['wc']);
    }

    public function test_delete_elimina_registro(): void
    {
        $id = $this->service->crear([
            'titulo' => 'Para borrar',
            'precio' => 50000,
            'descripcion' => str_repeat('Descripción válida para borrar luego. ', 3),
            'habitaciones' => 1,
            'wc' => 1,
            'estacionamiento' => 0,
            'vendedor_id' => 1,
        ]);

        $row = $this->repo->findById($id);
        $this->assertNotNull($row);

        $ok = $this->repo->delete($id);
        $this->assertTrue($ok);

        $this->assertNull($this->repo->findById($id));
    }

    public function test_crear_falla_con_descripcion_corta(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->service->crear([
            'titulo' => 'Casa',
            'precio' => 90000,
            'descripcion' => 'Muy corta', // < 60
        ]);
    }
}
