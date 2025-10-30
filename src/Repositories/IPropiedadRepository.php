<?php
declare(strict_types=1);

namespace Repositories;

interface IPropiedadRepository
{
    public function save(array $data): int;
}
