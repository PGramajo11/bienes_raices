<?php
declare(strict_types=1);

namespace Services;

use Domain\Propiedades\PropiedadValidator;
use Repositories\IPropiedadRepository;

final class PropiedadService
{
    public function __construct(private IPropiedadRepository $repo)
    {
    }

    public function crear(array $input): int
    {
        $validados = PropiedadValidator::validar($input);
        $id = $this->repo->save($validados);
        if ($id <= 0) {
            throw new \RuntimeException('No se pudo crear la propiedad (repo).');
        }
        return $id;
    }
}
