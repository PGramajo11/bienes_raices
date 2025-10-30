<?php
declare(strict_types=1);

namespace Repositories;

final class PropiedadRepositoryPdo implements IPropiedadRepository
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function save(array $data): int
    {
        $sql = "INSERT INTO propiedad
                  (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, vendedor_id, creado)
                VALUES
                  (:titulo, :precio, :imagen, :descripcion, :habitaciones, :wc, :estacionamiento, :vendedor_id, NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $data['titulo'],
            ':precio' => $data['precio'],
            ':imagen' => $data['imagen'] ?? null,
            ':descripcion' => $data['descripcion'],
            ':habitaciones' => $data['habitaciones'] ?? 0,
            ':wc' => $data['wc'] ?? 0,
            ':estacionamiento' => $data['estacionamiento'] ?? 0,
            ':vendedor_id' => $data['vendedor_id'] ?? 1, // NOT NULL en tu BD
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM propiedad WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE propiedad SET
                    titulo = :titulo,
                    precio = :precio,
                    imagen = :imagen,
                    descripcion = :descripcion,
                    habitaciones = :habitaciones,
                    wc = :wc,
                    estacionamiento = :estacionamiento,
                    vendedor_id = :vendedor_id
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $data['titulo'],
            ':precio' => $data['precio'],
            ':imagen' => $data['imagen'] ?? null,
            ':descripcion' => $data['descripcion'],
            ':habitaciones' => $data['habitaciones'] ?? 0,
            ':wc' => $data['wc'] ?? 0,
            ':estacionamiento' => $data['estacionamiento'] ?? 0,
            ':vendedor_id' => $data['vendedor_id'] ?? 1, // NOT NULL en tu BD
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM propiedad WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function countAll(): int
    {
        return (int) $this->pdo->query("SELECT COUNT(*) FROM propiedad")->fetchColumn();
    }
}
